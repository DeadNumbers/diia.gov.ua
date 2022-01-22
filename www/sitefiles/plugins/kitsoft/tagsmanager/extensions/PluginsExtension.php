<?php

namespace KitSoft\TagsManager\Extensions;

use App;

class PluginsExtension
{
	protected $plugins = [
        'KitSoft\NPA\Models\Act' => 'KitSoft\NPA\Controllers\Acts',
        'KitSoft\Events\Models\Event' => 'KitSoft\Events\Controllers\Events',
        'KitSoft\MediaGallery\Models\MediaGallery' => 'KitSoft\MediaGallery\Controllers\MediaGalleries',
        'KitSoft\Meetings\Models\Meeting' => 'KitSoft\Meetings\Controllers\Meetings',
        'KitSoft\Ministries\Models\Ministry' => 'KitSoft\Ministries\Controllers\Ministries',
        'KitSoft\Pages\Models\Page' => 'KitSoft\Pages\Controllers\Pages',
        'KitSoft\Persons\Models\Person' => 'KitSoft\Persons\Controllers\Persons',
        'KitSoft\Services\Models\Service' => 'KitSoft\Services\Controllers\Services',
        'KitSoft\Projects\Models\Project' => 'KitSoft\Projects\Controllers\Projects',
        'RainLab\Blog\Models\Post' => 'RainLab\Blog\Controllers\Posts',
        'Graker\PhotoAlbums\Models\Album' => 'Graker\PhotoAlbums\Controllers\Albums'
    ];

    /**
     * __construct
     */
    public function __construct() {
    	$this->extendPlugins();
    }

    /**
     * extendPlugins
     */
    protected function extendPlugins() {
    	foreach($this->plugins as $model => $controller) {
            if(!class_exists($model) || !class_exists($controller)) {
                continue;
            }

            // extend models
            $model::extend(function($model) {
                $model->implement[] = 'KitSoft.TagsManager.Behaviors.ModelBehavior';
            }, 1);

            // extend controllers
            $controller::extend(function($controller) {
                $controller->implement[] = 'KitSoft.TagsManager.Behaviors.ControllerBehavior';
            }, 2);
        }
    }
}
