<?php namespace KitSoft\Pages\Components;

use Cms\Classes\ComponentBase;
use KitSoft\Pages\Models\Page;

class lastPages extends ComponentBase
{
    public $pages;
    public $label;
    public $buttonLabel;

    public function componentDetails()
    {
        return [
            'name'        => 'kitsoft.pages::lang.components.lastPages.name',
            'description' => 'kitsoft.pages::lang.components.lastPages.description'
        ];
    }

    /**
     * defineProperties
     */
    public function defineProperties()
    {
        return [
            'count' => [
                'title' => 'kitsoft.pages::lang.components.lastPages.fields.count',
                'type' => 'dropdown',
                'required' => true,
                'options' => array_combine($range = range(1, 10), $range),
                'group' => 'kitsoft.pages::lang.components.lastPages.mainTab'
            ],
            'label' => [
                'title' => 'kitsoft.pages::lang.components.lastPages.fields.label',
                'group' => 'kitsoft.pages::lang.components.lastPages.mainTab'
            ],
            'buttonLabel' => [
                'title' => 'kitsoft.pages::lang.components.lastPages.fields.buttonLabel',
                'group' => 'kitsoft.pages::lang.components.lastPages.mainTab'
            ]
        ];
    }

    public function onRun()
    {
        $this->pages = $this->loadPages();
        $this->label = $this->property('label');
        $this->buttonLabel = $this->property('buttonLabel');
    }

    protected function loadPages()
    {
        return Page::isPublished()
            ->limit($this->property('count') ?? 3)
            ->isNotSluggable()
            ->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}