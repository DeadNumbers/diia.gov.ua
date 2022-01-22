<?php namespace KitSoft\Services\Components;

use Cms\Classes\ComponentBase;
use KitSoft\Services\Models\Category as CategoryModel;
use KitSoft\Services\Models\Service;

class CategorySubcategory extends ComponentBase
{
    public $category;
    public $subcategory;
    public $servicesByLetters;

    public function componentDetails()
    {
        return [
            'name'        => 'Category with subcategory',
            'description' => 'Посилання сторінки має бути динамічним [:category_slug/:subcategory_slug]. Сторінка має належати батьківській сторінці з динамічним посиланням.'
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->category = $this->loadCategory();
        $this->subcategory = $this->loadSubCategory();

        if (!$this->category || !$this->subcategory) {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }

        $this->servicesByLetters = $this->loadServicesByLetters();
    }

    /**
     * loadCategory
     */
    protected function loadCategory()
    {
        return CategoryModel::with('subcategories')
            ->where('slug', $this->param('category_slug'))
            ->first();
    }

    /**
     * loadSubCategory
     */
    protected function loadSubCategory()
    {
        if (!$this->category) {
            return;
        }

        $subcategory = $this->category
            ->getSubcategoryTree($this->param('subcategory_slug'));
        
        if ($subcategory) {
            $subcategory->load([
                'life_situations' => function ($query) {
                    return $query->isPublished();
                },
                'services' =>  function ($query) {
                    return $query->isPublished();
                }
            ]);
            
            $subcategory->children->each(function ($item) {
                $item->load(['services' => function ($query) {
                    return $query->isPublished();
                }]);
            });
        }

        return $subcategory;
    }

    /**
     * loadServicesByLetters
     */
    protected function loadServicesByLetters()
    {
        return Service::isPublished()
            ->whereHas('subcategories', function ($query) {
                return $query
                    ->where('id', $this->subcategory->id)
                    ->orWhereIn('id', $this->subcategory->children->lists('id'));
            })
            ->orderBy('title')
            ->get()
            ->groupBy(function ($item) {
                return mb_substr($item->title, 0, 1);
            });
    }
}
