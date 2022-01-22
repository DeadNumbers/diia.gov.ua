<?php namespace KitSoft\Sitemap;

use App;
use Backend;
use KitSoft\Sitemap\Classes\Register;
use System\Classes\PluginBase;

/**
 * Sitemap Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
        'KitSoft.Core',
        'KitSoft.Pages'
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Sitemap',
            'description' => '',
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
        Register::run($this->app);

        $this->registerConsoleCommand(
            'sitemap:build',
            'KitSoft\Sitemap\Console\Builder'
        );
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        App::make('KitSoft\Sitemap\Extensions\RobotsTxtExtension');
        App::make('KitSoft\Sitemap\Extensions\MirrorExtension');
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'kitsoft.sitemap.settings' => [
                'tab' => 'Sitemap',
                'label' => 'Sitemap'
            ],
        ];
    }

    /*
     * registerSchedule
     */
    public function registerSettings()
    {
        return [
            'sitemap' => [
                'label'       => 'Sitemap',
                'description' => '',
                'category'    => 'Sitemap',
                'icon'        => 'icon-cogs',
                'class'       => 'KitSoft\Sitemap\Models\Settings',
                'order'       => 501,
            ]
        ];
    }

    /*
     * registerSchedule
     */
    public function registerSchedule($schedule)
    {
        $schedule->command('sitemap:build')->dailyAt('04:00');
    }
}
