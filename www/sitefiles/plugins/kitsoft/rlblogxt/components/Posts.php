<?php namespace KitSoft\RLBlogXT\Components;

use Cache;
use Cms\Classes\ComponentBase;
use October\Rain\Argon\Argon;
use RainLab\Blog\Models\Category;
use RainLab\Blog\Models\Post;
use Exception;

class Posts extends ComponentBase
{
    public $posts;
    public $postsLabel;
    public $categories;

    /**
     * componentDetails
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'kitsoft.rlblogxt::lang.components.posts.name',
            'description' => 'kitsoft.rlblogxt::lang.components.posts.description'
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
                'title'    => 'kitsoft.rlblogxt::lang.components.posts.fields.count',
                'type'     => 'dropdown',
                'required' => true,
                'default'  => 9,
                'options'  => array_combine($range = range(1, 20), $range),
                'group'    => 'kitsoft.rlblogxt::lang.components.posts.tabs.main'
            ],
            'postsLabel' => [
                'title' => 'kitsoft.rlblogxt::lang.components.posts.fields.posts_label',
                'group' => 'kitsoft.rlblogxt::lang.components.posts.tabs.main'
            ],
            'isFixedOrder' => [
                'title' => 'kitsoft.rlblogxt::lang.components.posts.fields.is_fixed_order',
                'group' => 'kitsoft.rlblogxt::lang.components.posts.tabs.main',
                'type'  => 'checkbox'
            ],
            'isTopOrder' => [
                'title' => 'kitsoft.rlblogxt::lang.components.posts.fields.is_top_order',
                'group' => 'kitsoft.rlblogxt::lang.components.posts.tabs.main',
                'type'  => 'checkbox'
            ]
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->prepareVars();

        $this->posts = $this->loadPosts();
        $this->categories = $this->loadCategories();
    }

    /**
     * prepareVars
     */
    protected function prepareVars()
    {
        $this->postsLabel = $this->property('postsLabel');
    }

    /**
     * loadPosts
     */
    protected function loadPosts() {
        $query = Post::isPublished();

        // categories filter
        if ($categories = request()->get('categories')) {
            $query = $query->whereHas('categories', function ($query) use ($categories) {
                return $query->whereIn('slug', (array)$categories);
            });
        }

        // from
        $query = request()->has('from')
            ? $query->whereDate('published_at', '>=', Argon::parse(request()->get('from')))
            : $query;

        // to
        $query = request()->has('to')
            ? $query->whereDate('published_at', '<=', Argon::parse(request()->get('to')))
            : $query;

        // isFixedOrder
        $query = $this->property('isFixedOrder')
            ? $query->orderBy('is_fixed', 'DESC')
            : $query;

        // isTopOrder
        $query = $this->property('isTopOrder')
            ? $query->orderBy('is_top', 'DESC')
            : $query;

        return $query->orderBy('published_at', 'DESC')
            ->paginate($this->property('count'))
            ->appends(request()->all());
    }

    /**
     * onPosts
     */
    protected function onPosts()
    {        
        try {
            $cacheKey = 'kitsoft.pages.components.posts.' . request()->getQueryString();

            $data = Cache::remember($cacheKey, 3, function() {
                $this->prepareVars();

                $this->posts = $this->loadPosts();

                $data = $this->posts->toArray();
                unset(
                    $data['data'],
                    $data['first_page_url'],
                    $data['last_page_url'],
                    $data['next_page_url'],
                    $data['path'],
                    $data['prev_page_url']
                );
                $data['render'] = $this->renderPartial('posts::items');
                $data['pagination'] = $this->renderPartial('posts::pagination');

                return $data;
            });
        } catch (Exception $e) {
            return response()
                ->json('Something was wrong', 500);
        }

        return response()
            ->json($data, 200);
    }

    /**
     * loadCategories
     */
    protected function loadCategories()
    {
        return Category::whereHas('posts')
            ->getAllRoot();
    }
}