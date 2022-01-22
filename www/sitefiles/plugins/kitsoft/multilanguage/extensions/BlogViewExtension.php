<?php namespace KitSoft\MultiLanguage\Extensions;

use Event;
use Rainlab\Blog\Models\Post;
use Rainlab\Blog\Controllers\Categories as CategoriesController;
use Rainlab\Blog\Controllers\Posts as PostsController;

class BlogViewExtension
{
    /*
     * Init
     */
    public function __construct()
    {
        //$this->extendPosts();
        $this->extendCategories();
    }

    /**
     * extendPosts
     */
    protected function extendPosts()
    {
        if (!class_exists('Rainlab\Blog\Controllers\Posts')) {
            return;
        }

        PostsController::extend(function ($controller) {
            if (get_class($controller) !== 'RainLab\Blog\Controllers\Posts') {
                return;
            }
            $controller->formConfig = __DIR__ . '/fields/blog/config_form.yaml';
            $controller->addViewPath(__DIR__ . '/views/blog');
            Event::fire('kitsoft.multilanguage.blogPostController', [&$controller]);
        });
    }

    /**
     * extendCategories
     */
    protected function extendCategories()
    {
        if (!class_exists('Rainlab\Blog\Controllers\Categories')) {
            return;
        }

        CategoriesController::extend(function ($controller) {
            if (get_class($controller) !== 'RainLab\Blog\Controllers\Categories') {
                return;
            }
            $controller->addViewPath(__DIR__ . '/views/blog_categories');
            $controller->bodyClass = 'compact-container';
        });
    }
}
