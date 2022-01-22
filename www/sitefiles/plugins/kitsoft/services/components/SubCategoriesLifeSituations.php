<?php namespace KitSoft\Services\Components;

use Cms\Classes\ComponentBase;
use KitSoft\Services\Models\SubCategory;

class SubCategoriesLifeSituations extends ComponentBase
{
    public $subcategories;

    public function componentDetails()
    {
        return [
            'name'        => 'Subcategories with Life Situations',
            'description' => ''
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->subcategories = $this->loadSubcategories();
    }

    /**
     * loadSubcategories
     */
    protected function loadSubcategories()
    {
        return SubCategory::make()
            ->whereHas('life_situations', function ($query) {
                return $query->whereNull('parent_id')
                    ->isPublished();
            })
            ->with(['life_situations' => function ($query) {
                return $query->whereNull('parent_id')
                    ->isPublished();
            }])
            ->orderBy('name', 'asc')
            ->get();
    }
}
