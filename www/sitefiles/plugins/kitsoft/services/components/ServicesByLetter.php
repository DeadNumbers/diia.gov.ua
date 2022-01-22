<?php namespace KitSoft\Services\Components;

use Cms\Classes\ComponentBase;
use KitSoft\Services\Models\Service;
use KitSoft\Services\Models\SubCategory;

class ServicesByLetter extends ComponentBase
{
    public $letters;

    public function componentDetails()
    {
        return [
            'name'        => 'Services By Letter',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [
            'subcategoriesFilter' => [
                'title' => 'Subcategories',
                'group' => 'Categories',
                'type' => 'checkboxlist',
                'options' => SubCategory::lists('name', 'id'),
                'span' => false,
            ],
            'subcategoriesFilterByGetParam' => [
                'title' => 'Увімкнути можливість фільтрування підкатегорій за допомогою GET параметру subcategories [/services/list?subcategories=category_1,...,category_N]',
                'group' => 'Categories',
                'type' => 'checkbox',
                'span' => false
            ]
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->letters = $this->loadGroupedServices();
    }

    /**
     * loadGroupedServices
     */
    protected function loadGroupedServices()
    {
        $query = Service::isPublished();
        
        // filter by subcategories from component settings
        if ($subcategories = $this->property('subcategoriesFilter')) {
            $query = $query->whereHas('subcategories', function ($query) use ($subcategories) {
                return $query->whereIn('id', $subcategories);
            });
        }

        // filter by subcategories by request get param - subcategories
        $subcategories = request()->get('subcategories');
        if ($subcategories && $this->property('subcategoriesFilterByGetParam')) {
            $query = $query->whereHas('subcategories', function ($query) use ($subcategories) {
                return $query->whereIn('slug', explode(',', $subcategories));
            });
        }

        return $query->orderBy('title')
            ->get()
            ->groupBy(function ($item) {
                return mb_substr($item->title, 0, 1);
            });
    }
}
