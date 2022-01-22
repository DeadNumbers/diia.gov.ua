<?php namespace KitSoft\Pages\Console;

use Db;
use Exception;
use Cms\Classes\Page as CmsPage;
use Cms\Classes\Theme;
use Illuminate\Console\Command;
use KitSoft\Pages\Models\Menu;
use KitSoft\Pages\Models\MenuItem;
use KitSoft\Pages\Models\Page;
use RainLab\Pages\Classes\Menu as PagesMenu;
use RainLab\Pages\Classes\Page as StaticPage;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ImportRainLabMenu extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'pages:importrainlabmenu';

    /**
     * @var string The console command description.
     */
    protected $description = 'No description provided yet...';

    public $activeMenuItem = false;

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $this->output->writeln('Start!');

        $theme = Theme::getEditTheme();
        $menus = PagesMenu::listInTheme($theme, true);

        $this->output->writeln('Begin Transaction');
        Db::beginTransaction();
        try {
            foreach ($menus as $menu) {
                $newMenu = Menu::make();
                $newMenu->name = $menu->name;
                $newMenu->code = $menu->code;
                $newMenu->save();

                $this->importMenu($menu->items, $newMenu->id);
            }
        } catch (Exception $e){
            $this->output->writeln('Transaction Rollback');
            $this->output->writeln($e->getMessage());
            Db::rollback();
            die;
        }

        $this->output->writeln('Transaction Commit');
        Db::commit();

        $this->output->writeln('Complete!');
    }

    /**
     * importMenu, recursive
     */
    public function importMenu($items, $menu_id, $parent_id = null) {
        foreach($items as $item) {
            $this->output->writeln($item->title . ' ' . $item->type);

            $newMenuItem = MenuItem::make();
            $newMenuItem->title = $item->title;
            $newMenuItem->menu_id = $menu_id;
            $newMenuItem->parent_id = $parent_id;
            $newMenuItem->isHidden = $item->viewBag['isHidden'];
            $newMenuItem->isExternal = $item->viewBag['isExternal'];

            switch ($item->type) {
                case 'static-page':
                    $staticPage = StaticPage::find($item->reference);
                    $slug = rtrim($staticPage->url, '/');
                    $slug = explode('/', $slug);
                    $slug = end($slug);

                    $page = Page::where('slug', $slug)->first();

                    $newMenuItem->type = 'page';
                    $newMenuItem->value = $page ? $page->id : null;

                    break;
                case 'header':
                    $newMenuItem->type = 'header';

                    break;
                case 'cms-page':
                    $newMenuItem->type = 'cmsPage';
                    $newMenuItem->value = $item->reference;

                    break;
                case 'url':
                    $newMenuItem->type = 'link';
                    $newMenuItem->value_link = $item->url;

                    break;
                default:
                    break;
            }

            $newMenuItem->forceSave();

            $this->importMenu($item->items, $menu_id, $newMenuItem->id);
        }
    }
}
