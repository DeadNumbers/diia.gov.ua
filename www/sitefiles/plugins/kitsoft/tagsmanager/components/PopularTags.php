<?php namespace KitSoft\TagsManager\Components;

use Cms\Classes\ComponentBase;
use KitSoft\Pages\Models\Page;
use KitSoft\TagsManager\Models\Tag;

class PopularTags extends ComponentBase
{
    public $title;
    public $tagPage;
    public $tags;

    public function componentDetails()
    {
        return [
            'name'        => 'Popular Tags',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title' => 'Title',
                'group' => 'Options'
            ],
            'count' => [
                'title' => 'Count',
                'type' => 'dropdown',
                'required' => true,
                'default' => 5,
                'options' => array_combine($range = range(1, 20), $range),
                'group' => 'Options'
            ],
            'tagPage' => [
                'title' => 'Tag Page',
                'type' => 'dropdown',
                'options' => Page::make()->getPagesOptions(),
                'group' => 'Options'
            ]
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->prepareVars();
        $this->tags = $this->loadTags();
    }

    /**
     * prepareVars
     */
    protected function prepareVars()
    {
        $this->title = $this->property('title');
        $this->tagPage = $this->property('tagPage');
    }

    /**
     * loadTags
     */
    protected function loadTags()
    {
        return Tag::withCount('entities')
            ->orderByDesc('entities_count')
            ->limit($this->property('count'))
            ->get();
    }
}
