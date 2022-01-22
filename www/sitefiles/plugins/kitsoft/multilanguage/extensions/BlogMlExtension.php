<?php namespace KitSoft\Multilanguage\Extensions;

use Event;
use File;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use Rainlab\Blog\Controllers\Categories as CategoriesController;
use Rainlab\Blog\Controllers\Posts as PostsController;
use Rainlab\Blog\Models\Category as CategoryModel;
use Rainlab\Blog\Models\Post as PostModel;
use Yaml;

class BlogMlExtension
{
    /*
     * Construct
     */
	public function __construct() {
        $this->extendPosts();
        $this->extendCategories();        
	}

    /**
     * extendPosts
     */
    protected function extendPosts() {
        if (!class_exists('Rainlab\Blog\Controllers\Posts')) {
            return;
        }

        // multilanguage model
        PostModel::extend(function($model) {
            $model->implement[] = 'KitSoft.MultiLanguage.Behaviors.MultiLanguageModel';
        }, 2);

        // multilanguage controller, change some views
        PostsController::extend(function($controller) {
            $controller->implement[] = 'KitSoft.MultiLanguage.Behaviors.MultiLanguageController';
        }, 2);
    }

    /**
     * extendCategories
     */
    protected function extendCategories() {
        if (!class_exists('Rainlab\Blog\Controllers\Categories')) {
            return;
        }

        // multilanguage model
        CategoryModel::extend(function($model) {
            $model->implement[] = 'KitSoft.MultiLanguage.Behaviors.MultiLanguageModel';
        }, 2);

        // multilanguage controller, change some views
        CategoriesController::extend(function($controller) {
            $controller->implement[] = 'KitSoft.MultiLanguage.Behaviors.MultiLanguageController';
        }, 2);
    }
}