<?php namespace KitSoft\Pages\Faker;

use KitSoft\Core\Console\Interfaces\ContentGenerationInterface;
use KitSoft\Core\Classes\AbstractContentGeneration;
use KitSoft\Pages\Models\Page;
use October\Rain\Database\Model;
use KitSoft\Core\Classes\ImportHelpers;

class Pages extends AbstractContentGeneration implements ContentGenerationInterface
{
    public static $sort = 13;

    /**
     * create
     */
    protected function create(): Page
    {
        $page = new Page();

        $page->title = $this->factory->words(4, TRUE);
        $page->slug = ImportHelpers::getUniqueSlug($page, str_slug($page->title), 'slug', '-', 191);
        $page->layout = 'page';
        $page->published = true;
        $page->content = '<p>'.$this->factory->realText(450).'</p>';
        $page->parent_id = $this->getRandomParent($page);

        $this->attachRandomTag($page);

        $page->save();

        return $page;
    }

    /**
     * getRandomParent
     */
    protected function getRandomParent(Model $model)
    {
        if (!$this->factory->boolean) {
            return;
        }
        if (!$page = $model->where('is_system', false)->inRandomOrder()->first()) {
            return;
        }
        return $page->id;
    }
}