<?php namespace KitSoft\Services\Components;

use Cms\Classes\ComponentBase;
use KitSoft\Services\Models\Service;

class TopServices extends ComponentBase
{
    public $services;

    public function componentDetails()
    {
        return [
            'name'        => 'Top Services',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [
            'count' => [
                'title' => 'kitsoft.services::lang.components.topservices.count',
                'type' => 'dropdown',
                'required' => true,
                'options' => array_combine($range = range(1, 20), $range),
                'group' => 'Options'
            ],
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->services = $this->loadServices();
    }

    /**
     * loadServices
     */
    protected function loadServices()
    {
        return Service::isPublished()
            ->orderBy('hits', 'desc')
            ->orderBy('title')
            ->limit($this->property('count') ?? 5)
            ->get();
    }
}
