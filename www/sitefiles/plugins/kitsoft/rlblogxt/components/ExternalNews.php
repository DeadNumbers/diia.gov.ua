<?php namespace KitSoft\RLBlogXT\Components;

use Cms\Classes\ComponentBase;

class ExternalNews extends ComponentBase
{
    public $label,
        $count,
        $apiUrl,
        $buttonLabel,
        $buttonUrl,
        $target;

    /**
     * componentDetails
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'kitsoft.rlblogxt::lang.components.external_news.name',
            'description' => 'kitsoft.rlblogxt::lang.components.external_news.description'
        ];
    }

    /**
     * defineProperties
     * @return array
     */
    public function defineProperties()
    {
        return [
            'label' => [
                'title' => 'kitsoft.rlblogxt::lang.components.external_news.fields.posts',
                'group' => 'kitsoft.rlblogxt::lang.components.external_news.tabs.main'
            ],
            'count' => [
                'title'    => 'kitsoft.rlblogxt::lang.components.external_news.fields.count',
                'type'     => 'dropdown',
                'required' => true,
                'options'  => array_combine($range = range(1, 20), $range),
                'group'    => 'kitsoft.rlblogxt::lang.components.external_news.tabs.main'
            ],
            'apiUrl' => [
                'title' => 'kitsoft.rlblogxt::lang.components.external_news.fields.api_url',
                'group' => 'kitsoft.rlblogxt::lang.components.external_news.tabs.main'
            ],
            'buttonLabel' => [
                'title' => 'kitsoft.rlblogxt::lang.components.external_news.fields.button_label',
                'group' => 'kitsoft.rlblogxt::lang.components.external_news.tabs.button'
            ],
            'buttonUrl' => [
                'title' => 'kitsoft.rlblogxt::lang.components.external_news.fields.button_url',
                'group' => 'kitsoft.rlblogxt::lang.components.external_news.tabs.button'
            ],
            'target' => [
                'title' => 'kitsoft.rlblogxt::lang.components.external_news.fields.target',
                'type'  => 'checkbox',
                'group' => 'kitsoft.rlblogxt::lang.components.external_news.tabs.button'
            ],
        ];
    }

    /**
     * onRun
     */
    public function onRun() {
        $this->label  = $this->property('label');
        $this->count  = $this->property('count');
        $this->apiUrl = $this->property('apiUrl');
        $this->target = $this->property('target');
        $this->buttonUrl   = $this->property('buttonUrl');
        $this->buttonLabel = $this->property('buttonLabel');
    }
}
