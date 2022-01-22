<?php namespace KitSoft\TagsManager\Components;

use Cms\Classes\ComponentBase;
use KitSoft\TagsManager\Models\Tag;

class TagPage extends ComponentBase
{
    public $tag;

    /**
     * componentDetails
     */
    public function componentDetails()
    {
        return [
            'name' => 'TagPage',
            'description' => 'TagPage Component',
        ];
    }

    /**
     * defineProperties
     */
    public function defineProperties()
    {
        return [
            'slug' => [
                'title' => 'rainlab.blog::lang.settings.post_slug',
                'description' => 'rainlab.blog::lang.settings.post_slug_description',
                'default' => '{{ :slug }}',
                'type' => 'string',
            ],
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        if(!$this->tag = Tag::where('slug', $this->property('slug'))->first()) {
            return $this->controller->run('404');
        }
    }
}
