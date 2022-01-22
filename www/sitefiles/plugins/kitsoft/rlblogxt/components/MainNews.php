<?php namespace KitSoft\RLBlogXT\Components;

use Cache;
use Cms\Classes\ComponentBase;
use RainLab\Blog\Models\Post;
use RainLab\Blog\Models\Category;
use Validator;
use ValidationException;

class MainNews extends ComponentBase
{
    const DEFAULT_CATEGORIES_LIMIT = 5;
    const DEFAULT_POSTS_LIMIT = 12;

    public $categories;

    /**
     * componentDetails
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'kitsoft.rlblogxt::lang.components.main_news.name',
            'description' => 'kitsoft.rlblogxt::lang.components.main_news.description'
        ];
    }

    /**
     * defineProperties
     * @return array
     */
    public function defineProperties()
    {
        return [
            'categoriesCount' => [
                'title'    => 'kitsoft.rlblogxt::lang.components.main_news.fields.categories_count',
                'type'     => 'dropdown',
                'required' => true,
                'options'  => array_combine($range = range(1, 20), $range),
                'group'    => 'kitsoft.rlblogxt::lang.components.main_news.tabs.main'
            ],
            'postsCount' => [
                'title'    => 'kitsoft.rlblogxt::lang.components.main_news.fields.posts_count',
                'type'     => 'dropdown',
                'required' => true,
                'options'  => array_combine($range = range(1, 20), $range),
                'group'    => 'kitsoft.rlblogxt::lang.components.main_news.tabs.main'
            ]
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->addJs('/plugins/kitsoft/rlblogxt/assets/js/news.js');

        $this->categories = $this->loadCategories();
    }

    /**
     * loadCategories with posts and tags
     */
    protected function loadCategories()
    {
        return Category::where('favourite', true)
            ->orderBy('nest_left', 'asc')
            ->take($this->property('categoriesCount') ?? self::DEFAULT_CATEGORIES_LIMIT)
            ->get()
            ->each(function ($item) {
                $cacheKey = "kitsoft.rlblogxt::categoryTags.{$item->id}";

                $item->tags = Cache::remember($cacheKey, 60 * 12, function () use ($item) {
                    return $item->tagList;
                });

                $item->attributes['posts'] = Post::isPublished()
                    ->with('tags', 'featured_images')
                    ->filterCategories([$item->id])
                    ->orderBy('is_fixed', 'desc')
                    ->orderBy('published_at', 'desc')
                    ->limit($this->property('postsCount') ?? self::DEFAULT_POSTS_LIMIT)
                    ->get();    
            });
    }

    /**
     * onLoadPostsByCategoryAndTag
     */
    public function onLoadPostsByCategoryAndTag()
    {
        $data = request()->only(['category', 'tag']);

        $validator = Validator::make($data, [
            'category' => 'required|int',
            'tag' => 'required|int'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $firstCategory = Category::orderBy('nest_left', 'asc')
            ->first();

        $items = Post::isPublished()
            ->with('featured_images', 'tags')
            ->filterCategories([$data['category']])
            ->filterTags([$data['tag']])
            ->orderBy('is_fixed', 'desc')
            ->orderBy('published_at', 'desc')
            ->limit($this->property('postsCount') ?? self::DEFAULT_POSTS_LIMIT)
            ->get()
            ->each(function ($item) {
                $item->url = $item->url;
            });

        return response()->json([
            'data' => $items,
            'main' => ($firstCategory && $firstCategory->id == $data['category'])
        ]);
    }
}