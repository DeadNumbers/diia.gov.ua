<?php namespace KitSoft\RLBlogXT\Components;

use Cms\Classes\ComponentBase;
use RainLab\Blog\Models\Category as CategoryModel;

class Category extends ComponentBase
{
    public $category;

    /**
     * componentDetails
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'kitsoft.rlblogxt::lang.components.category.name',
            'description' => 'kitsoft.rlblogxt::lang.components.category.description'
        ];
    }

    /**
     * componentDetails
     * @return array
     */
    public function defineProperties()
    {
        return [];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        if (!$this->category = $this->loadCategory()) {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }
    }

    /**
     * loadCategory
     */
    protected function loadCategory()
    {
        return CategoryModel::make()
            ->whereHas('posts', function ($query) {
                return $query->isPublished();
            })
            ->where('slug', $this->param('slug'))
            ->first();
    }
}
