<?php namespace KitSoft\Digest;

use App;
use Backend;
use System\Classes\PluginBase;

/**
 * Digest Plugin Information File
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
            'name'        => 'Digest',
            'description' => 'Digest Sender',
            'author'      => 'KitSoft',
            'icon'        => 'icon-mail'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConsoleCommand('digest.syncsubscribers', 'KitSoft\Digest\Console\SyncSubscribers');
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        App::make('KitSoft\Digest\Classes\RegisterDrivers');
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'KitSoft\Digest\Components\Subscribe' => 'subscribe',
            'KitSoft\Digest\Components\Settings' => 'digestSettings',
            'KitSoft\Digest\Components\Template' => 'digestTemplate'
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'kitsoft.digest.some_permission' => [
                'tab' => 'Digest',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'subscribers' => [
                'label'       => 'Subscribers',
                'description' => '',
                'icon'        => 'icon-users',
                'url'         => Backend::url('kitsoft/digest/subscribers'),
                'order'       => 550,
                'category'    => 'Digest',
                'permissions' => ['kitsoft.digest.manage_subscribers']
            ],
            'listssync' => [
                'label'       => 'Lists sync',
                'description' => '',
                'icon'        => 'icon-list',
                'url'         => Backend::url('kitsoft/digest/listssync'),
                'order'       => 551,
                'category'    => 'Digest',
                'permissions' => ['kitsoft.digest.manage_listssync']
            ],
            'settings' => [
                'label'       => 'Settings',
                'description' => '',
                'icon'        => 'icon-cogs',
                'class'       => 'KitSoft\Digest\Models\Settings',
                'order'       => 552,
                'category'    => 'Digest',
                'permissions' => ['kitsoft.digest.manage_settings']
            ]
        ];
    }

    /**
     * Registers mail templates
     *
     * @return array
     */
    public function registerMailTemplates()
    {
        return [
            'kitsoft.digest::subscribe' => 'Activation digest sent to new users.',
        ];
    }
}
