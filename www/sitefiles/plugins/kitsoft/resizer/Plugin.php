<?php namespace KitSoft\Resizer;

use App;
use Backend;
use System\Classes\PluginBase;

/**
 * Resizer Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Resizer',
            'description' => 'No description provided yet...',
            'author'      => 'KitSoft',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        App::make('KitSoft\Resizer\Extensions\SettingsControllerExtension');
        App::make('KitSoft\Resizer\Extensions\MirrorExtension');
    }

    /*
     * registerSchedule
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Settings',
                'description' => '',
                'category'    => 'Resizer',
                'icon'        => 'icon-image',
                'class'       => 'KitSoft\Resizer\Models\Settings',
                'order'       => 520,
            ]
        ];
    }

    /*
     * Register twig filters
     */
    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'resize' => ['KitSoft\Resizer\Twig\Filters', 'resize'],
                'watermark' => ['KitSoft\Resizer\Twig\Filters', 'watermark'],
            ]
        ];
    }
}
