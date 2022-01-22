<?php namespace KitSoft\Services\Components;

use Cms\Classes\ComponentBase;
use KitSoft\Services\Models\Category as CategoryModel;

class Category extends ComponentBase
{
    public $item;

    public function componentDetails()
    {
        return [
            'name'        => 'Category',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    /**
     * onRun
     */
    public function onRun()
    { 
        if (!$this->item = $this->loadCategory()) {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }

        $this->page->hash = $this->item->hash;
    }

    /**
     * loadCategory
     */
    protected function loadCategory()
    {
        return CategoryModel::where('slug', $this->param('slug'))
            ->first();
    }
}
