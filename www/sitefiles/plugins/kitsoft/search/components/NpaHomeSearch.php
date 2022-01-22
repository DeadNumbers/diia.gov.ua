<?php namespace KitSoft\Search\Components;

use Cms\Classes\ComponentBase;
use KitSoft\NPA\Models\Category;

class NpaHomeSearch extends ComponentBase
{
    public $categories;

    public function componentDetails()
    {
        return [
            'name'        => 'NpaHomeSearch Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->categories = Category::all(); 
    }
}
