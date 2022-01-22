<?php namespace KitSoft\Revisions;

use App;
use Backend;
use System\Classes\PluginBase;

/**
 * revisions Plugin Information File
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
            'name'        => 'Revisions',
            'description' => 'No description provided yet...',
            'author'      => 'Maksym Nozhkin',
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
        App::make('KitSoft\Revisions\Extensions\PluginsExtension');
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'kitsoft.revisions.revisions.index' => [
                'tab' => 'Revisions',
                'label' => 'List'
            ]
        ];
    }

    /*
     * registerSettings
     */
    public function registerSettings()
    {
        return [
            'revisions' => [
                'label'       => 'Revisions',
                'description' => '',
                'category'    => 'Revisions',
                'icon'        => 'icon-history',
                'url'         => Backend::url('kitsoft/revisions/revisions'),
                'order'       => 500,
                'permissions' => ['kitsoft.revisions.revisions.index']
            ]
        ];
    }
}
