<?php namespace KitSoft\Search\Components;

use Cms\Classes\ComponentBase;
use KitSoft\TagsManager\Models\Tag;
use KitSoft\NPA\Models\Category;

class NpaSearch extends ComponentBase
{
    public $tags;
    public $categories;

    public function componentDetails()
    {
        return [
            'name'        => 'NpaSearch Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->tags = Tag::all();
        $this->categories = Category::all();
    }
}
