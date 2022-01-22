<?php namespace KitSoft\RLBlogXT\Components;

use Cms\Classes\ComponentBase;
use RainLab\Blog\Models\Post;

class PopularNews extends ComponentBase
{
    public $items;

    /**
     * componentDetails
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'kitsoft.rlblogxt::lang.components.popular_news.name',
            'description' => 'kitsoft.rlblogxt::lang.components.popular_news.description'
        ];
    }

    /**
     * defineProperties
     * @return array
     */
    public function defineProperties()
    {
        return [
            'count' => [
                'title'    => 'kitsoft.rlblogxt::lang.components.popular_news.fields.count',
                'type'     => 'dropdown',
                'required' => true,
                'options'  => array_combine($range = range(1, 20), $range),
                'group'    => 'kitsoft.rlblogxt::lang.components.popular_news.tabs.main'
            ]
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->items = $this->loadPosts();
    }

    /**
     * loadPosts
     */
    public function loadPosts() {
        $query = Post::isPublished()
            ->orderBy('hits', 'desc')
            ->limit($this->property('count') ?? 4);

        if ($slug = $this->param('slug')) {
            $query = $query->where('slug', '<>', $slug);
        }

        return $query->get();
    }
}
