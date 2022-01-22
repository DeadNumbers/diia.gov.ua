<?php namespace KitSoft\RLBlogXT\Components;

use RainLab\Blog\Models\Post;
use Cms\Classes\ComponentBase;
use RainLab\Blog\Models\Category;

class Categories extends ComponentBase
{
    public $items;
    public $postsLabel;
    public $addFixedNews;

    /**
     * componentDetails
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'kitsoft.rlblogxt::lang.components.categories.name',
            'description' => 'kitsoft.rlblogxt::lang.components.categories.description'
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
                'title'    => 'kitsoft.rlblogxt::lang.components.categories.fields.count',
                'type'     => 'dropdown',
                'required' => true,
                'options'  => array_combine($range = range(0, 20), $range),
                'group'    => 'kitsoft.rlblogxt::lang.components.categories.tabs.main',
                'default'  => 0,
                'span'     => 'left'
            ],
            'postsLabel' => [
                'title' => 'kitsoft.rlblogxt::lang.components.categories.fields.posts_label',
                'group' => 'kitsoft.rlblogxt::lang.components.categories.tabs.main',
                'span'  => 'right'
            ],
            'addFixedNews' => [
                'title'       => 'kitsoft.rlblogxt::lang.components.categories.fields.add_fixed_news',
                'group'       => 'kitsoft.rlblogxt::lang.components.categories.tabs.filter',
                'span'        => 'left',
                'type'        => 'checkbox',
                'description' => 'kitsoft.rlblogxt::lang.components.categories.fields.add_fixed_news_description'
            ],
            'postsCategoriesFilter' => [
                'title'   => 'kitsoft.rlblogxt::lang.components.categories.fields.post_categories_filter',
                'group'   => 'kitsoft.rlblogxt::lang.components.categories.tabs.filter',
                'span'    => 'left',
                'type'    => 'checkboxlist',
                'options' => Category::lists('name', 'id')
            ],
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->items      = $this->loadCategories();
        $this->postsLabel = $this->property('postsLabel');
        $this->addFixedNews = $this->property('addFixedNews');
    }

    /**
     * loadCategories with posts
     */
    protected function loadCategories()
    {
        $query = Category::whereHas('posts');

        if ($categories = $this->property('postsCategoriesFilter')) {
            $query = $query->whereIn('id', $categories);
        }

        return $query->get()
            ->each(function ($item) {
                $query = Post::isPublished()
                    ->filterCategories([$item->id])
                    ->limit($this->property('count'));

                $query = $this->property('addFixedNews')
                    ? $query->orderBy('is_fixed', 'DESC')
                    : $query;

                $query = $query->orderBy('published_at', 'desc');

                $item->attributes['posts'] = $query->get();

            });
    }
}