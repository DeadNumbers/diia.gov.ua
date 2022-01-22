<?php namespace KitSoft\Services\Components;

use Cms\Classes\ComponentBase;
use KitSoft\Services\Models\SubCategory;


class SubCategories extends ComponentBase
{
    public $subCategories;

    public function componentDetails()
    {
        return [
            'name'        => 'Services By SubCategories',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [
            'isTopServices' => [
                'title' => 'Тільки закріплені',
                'type' => 'checkbox',
                'group' => 'Сервіси',
                'span' => 'left'
            ], 
            'countServices' => [
                'title' => 'Кількість сервісів в підкатегоріях',
                'type' => 'dropdown',
                'required' => true,
                'default' => 0,
                'options' => array_combine($range = range(0, 20), $range),
                'group' => 'Сервіси',
                'span' => 'left'
            ],
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->subCategories = $this->loadSubCategories();
    }

    /**
     * loadSubCategories
     */
    protected function loadSubCategories()
    {
        return SubCategory::whereHas('services')
            // load only root subcategories in pivot sorting
            ->join('kitsoft_services_subcategories_categories as pivot', function ($query) {
                return $query->on('pivot.subcategory_id', '=', 'id')->whereNull('parent_id');
            })
            ->orderBy('name')
            ->get()
            ->each(function ($item) {
                $item->load(['services' => function ($query) {
                    $query = $query->isPublished();

                    if ($this->property('isTopServices')) {
                        $query = $query->isTop();
                    }

                    return $query->limit($this->property('countServices'));
                }]);
            })
            ->filter(function ($item) {
                if ($this->property('countServices')) {
                    return (boolean)$item->services->count();
                }
                return true;
            });
    }
}