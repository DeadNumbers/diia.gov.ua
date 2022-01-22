<?php namespace KitSoft\RLBlogXT\Components;

use RainLab\Blog\Models\Post;
use Cms\Classes\ComponentBase;
use RainLab\Blog\Models\Category;
use Illuminate\Support\Facades\DB;
use KitSoft\TagsManager\Models\Tag;

class LastNews extends ComponentBase
{
    public $posts;
    public $postsLabel;
    public $buttonLink;

    /**
     * componentDetails
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'kitsoft.rlblogxt::lang.components.lastnews.name',
            'description' => 'kitsoft.rlblogxt::lang.components.lastnews.description'
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
                'title'    => 'kitsoft.rlblogxt::lang.components.lastnews.fields.count',
                'type'     => 'dropdown',
                'required' => true,
                'options'  => array_combine($range = range(1, 20), $range),
                'group'    => 'kitsoft.rlblogxt::lang.components.lastnews.tabs.main'
            ],
            'postsLabel' => [
                'title' => 'kitsoft.rlblogxt::lang.components.lastnews.fields.posts_label',
                'group' => 'kitsoft.rlblogxt::lang.components.lastnews.tabs.main'
            ],
            'isFixedOrder' => [
                'title' => 'kitsoft.rlblogxt::lang.components.lastnews.fields.is_fixed_order',
                'group' => 'kitsoft.rlblogxt::lang.components.lastnews.tabs.filters',
                'type'  => 'checkbox',
                'span'  => 'left'
            ],
            'isTopOrder' => [
                'title' => 'kitsoft.rlblogxt::lang.components.lastnews.fields.is_top_order',
                'group' => 'kitsoft.rlblogxt::lang.components.lastnews.tabs.filters',
                'type'  => 'checkbox',
                'span'  => 'left'
            ],
            'isFixed' => [
                'title' => 'kitsoft.rlblogxt::lang.components.lastnews.fields.is_fixed',
                'group' => 'kitsoft.rlblogxt::lang.components.lastnews.tabs.filters',
                'type'  => 'checkbox',
                'span'  => 'left'
            ],
            'isTop' => [
                'title' => 'kitsoft.rlblogxt::lang.components.lastnews.fields.is_top',
                'group' => 'kitsoft.rlblogxt::lang.components.lastnews.tabs.filters',
                'type'  => 'checkbox',
                'span'  => 'left'
            ],
            'excludeFixed' => [
                'title' => 'kitsoft.rlblogxt::lang.components.lastnews.fields.exclude_fixed',
                'group' => 'kitsoft.rlblogxt::lang.components.lastnews.tabs.filters',
                'type'  => 'checkbox',
                'span'  => 'left'
            ],
            'excludeTop' => [
                'title' => 'kitsoft.rlblogxt::lang.components.lastnews.fields.exclude_top',
                'group' => 'kitsoft.rlblogxt::lang.components.lastnews.tabs.filters',
                'type'  => 'checkbox',
                'span'  => 'left'
            ],
            'excludeCurrentSlug' => [
                'title' => 'kitsoft.rlblogxt::lang.components.lastnews.fields.exclude_slug',
                'group' => 'kitsoft.rlblogxt::lang.components.lastnews.tabs.filters',
                'type'  => 'checkbox',
                'span'  => 'left'
            ],
            'excludeSlug' => [
                'type'    => 'hidden',
                'default' => '{{ :slug }}',
            ],
            'postsCategoriesFilter' => [
                'title'   => 'kitsoft.rlblogxt::lang.components.lastnews.fields.posts_categories_filter',
                'group'   => 'kitsoft.rlblogxt::lang.components.lastnews.tabs.categories',
                'type'    => 'checkboxlist',
                'options' => Category::lists('name', 'id'),
                'span'    => 'auto',
                'description' => 'kitsoft.rlblogxt::lang.components.lastnews.fields.posts_categories_filter_comment'
            ],
            'buttonLink' => [
                'title' => 'kitsoft.rlblogxt::lang.components.lastnews.fields.button_link',
                'type'  => 'relationfinder',
                'group' => 'kitsoft.rlblogxt::lang.components.lastnews.tabs.all_news',
                'span'  => 'left',
            ],
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->posts = $this->loadPosts();
        $this->postsLabel = $this->property('postsLabel');
        $this->buttonLink = $this->property('buttonLink');
    }

    /**
     * loadPosts
     */
    public function loadPosts() {
        $query = Post::isPublished()
            ->with('featured_images')
            ->limit($this->property('count') ?? 4);

        // order is_fixed
        $query = $this->property('isFixedOrder')
            ? $query->orderBy('is_fixed', 'DESC')
            : $query;

        // order is_top
        $query = $this->property('isTopOrder')
            ? $query->orderBy('is_top', 'DESC')
            : $query;

        // filter by is_fixed
        if ($this->property('isFixed')) {
            $query->where('is_fixed', true);
        }

        // filter by is_top
        if ($this->property('isTop')) {
            $query->where('is_top', true);
        }

        // exclude is_fixed
        if ($this->property('excludeFixed')) {
            $query->where('is_fixed', '<>', true);
        }

        // exclude is_top
        if ($this->property('excludeTop')) {
            $query->where('is_top', '<>', true);
        }

        // exclude current slug
        if ($this->property('excludeCurrentSlug')) {
            $query->where('slug', '<>', $this->property('excludeSlug'));
        }

        // have category
        if ($categories = $this->property('postsCategoriesFilter')) {
            $query = $query->filterCategories($categories);
        }

        $items = $query->orderBy('published_at', 'DESC')
            ->get();

        // for support old functionality
        $this->page['last_news'] = $items;

        return $items;
    }
}