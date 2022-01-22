<?php namespace KitSoft\TaxSystems\Components;

use Cms\Classes\ComponentBase;
use KitSoft\TaxSystems\Models\TaxSystem;

class TaxSystems extends ComponentBase
{
    public $items;

    public function componentDetails()
    {
        return [
            'name'        => 'Tax Systems',
            'description' => ''
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->items = $this->loadTaxSystems();
    }

    /**
     * loadTaxSystems
     */
    protected function loadTaxSystems()
    {
        return TaxSystem::isPublished()
            ->get();
    }
}
