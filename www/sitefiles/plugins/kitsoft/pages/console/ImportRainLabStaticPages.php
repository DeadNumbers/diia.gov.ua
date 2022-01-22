<?php namespace KitSoft\Pages\Console;

use Cms\Classes\Theme;
use Illuminate\Console\Command;
use KitSoft\Pages\Models\Page;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ImportRainLabStaticPages extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'pages:importrainlabstaticpages';

    /**
     * @var string The console command description.
     */
    protected $description = 'Import Static Pages from RainLab Plugin';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $this->output->writeln('Start!');

        if(!class_exists('\RainLab\Pages\Classes\PageList')) {
            dd('RainLab Static Pages not found!');
        }

        try {
            $theme = Theme::getEditTheme();
            $pages = (new \RainLab\Pages\Classes\PageList($theme))->getPageTree();
            $this->savePages($pages);
        } catch (Exception $e) {
            dd('Error: ' . $e->getMessage());
        }

        $this->output->writeln('Complete!');
    }

    /**
     * savePages
     */
    protected function savePages($items, $parent_id = null) {
        foreach($items as $item) {
            $segments = explode('/', $item->page->viewBag['url']);

            // generate unique slug with length 255
            $slug = end($segments);
            if(strlen($slug) > 255) {
                $slug = substr($slug, 0, 255 - 14) . '-' . uniqid();
            }

            // check if page already exist
            $query = Page::where('slug', $slug);
            $query = ($parent_id)
                ? $query->where('parent_id', $parent_id)
                : $query->whereNull('parent_id');

            if($page = $query->first()) {
                $this->output->writeln('Page already exist: ' . $item->page->viewBag['title']);
            } else {
                $this->output->writeln($item->page->viewBag['title']);
                
                $page = Page::make();
                $page->title = $item->page->viewBag['title'];
                $page->slug = $slug;
                $page->published = $item->page->viewBag['is_hidden'] ? false : true;
                
                if(class_exists('\KitSoft\TagsManager\Models\Tag') && isset($item->page->viewBag['tags'])) {
                    if($item->page->viewBag['tags'] != '0') {
                        $page->tags = $this->getTags($item->page->viewBag['tags']);
                    }
                }
                $content = explode('==', $item->page->content);
                $page->content = end($content);

                $page->fields = [
                    'meta_title' => $item->page->viewBag['meta_title'] ?? null,
                    'meta_description' => $item->page->viewBag['meta_description'] ?? null,
                    'link' => [
                        'url' => $item->page->viewBag['link'] ?? null,
                        'target' => $item->page->viewBag['link_target_blank'] ?? null
                    ],
                    'navigation_hidden' => $item->page->viewBag['navigation_hidden']
                ];

                $page->layout = 'static';
                $page->parent_id = $parent_id;

                $page->forceSave();
            }

            if(count($item->subpages)) {
                $this->savePages($item->subpages, $page->id);
            }
        }
    }

    /**
     * getTags
     */
    protected function getTags($tags) {
        $tags = $tags
            ? explode(',', $tags)
            : [];

        foreach($tags as &$tag) {
            $tag = trim($tag);
            if($existTag = \KitSoft\TagsManager\Models\Tag::where('name', $tag)->first()) {
                $tag = $existTag->id;
            } else {
                $data = \KitSoft\TagsManager\Models\Tag::make();
                $data->name = $tag;
                $data->slug = str_slug($tag);
                $data->save();
                $tag = $data->id;
            }
        }
        
        return $tags;
    }
}
