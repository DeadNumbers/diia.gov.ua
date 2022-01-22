<?php namespace KitSoft\Core;

use App;
use Backend;
use System\Classes\PluginBase;

/**
 * Core Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [];

    /**
     * __construct
     */
    public function __construct($app) {
        parent::__construct($app);

        if (class_exists('KitSoft\MultiSite\Plugin')) {
            $this->require[] = 'KitSoft.MultiSite';
        }
    }

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'kitsoft.core::lang.plugin.name',
            'description' => 'kitsoft.core::lang.plugin.description',
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
        $this->registerConsoleCommand('content.generation', 'KitSoft\Core\Console\ContentGeneration');
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        App::make('KitSoft\Core\Extensions\CollectionExtension');
        App::make('KitSoft\Core\Extensions\GoogleAnalyticsExtension');
        App::make('KitSoft\Core\Extensions\RobotsTxtExtension');
        App::make('KitSoft\Core\Extensions\DomainChangingExtension');
        App::make('KitSoft\Core\Extensions\SentryExtension');
        App::make('KitSoft\Core\Extensions\BackendUserExtension');
        App::make('KitSoft\Core\Extensions\RichEditorExtension');
        App::make('KitSoft\Core\Extensions\MirrorExtension');
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'KitSoft\Core\Components\GoogleAnalytics' => 'googleAnalytics',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'kitsoft.core.manage_google_analytics'  => [
                'tab'   => 'kitsoft.core::lang.plugin.name',
                'label' => 'kitsoft.core::lang.permissions.manage_google_analytics'
            ],
            'kitsoft.core.manage_robots_txt'  => [
                'tab'   => 'kitsoft.core::lang.plugin.name',
                'label' => 'kitsoft.core::lang.permissions.manage_robots_txt'
            ],
            'kitsoft.core.manage_settings'  => [
                'tab'   => 'kitsoft.core::lang.plugin.name',
                'label' => 'kitsoft.core::lang.permissions.manage_settings'
            ],
            'kitsoft.core.manage_domain_changing'  => [
                'tab'   => 'kitsoft.core::lang.plugin.name',
                'label' => 'kitsoft.core::lang.permissions.manage_domain_changing'
            ],
            'kitsoft.core.manage_sentry'  => [
                'tab'   => 'kitsoft.core::lang.plugin.name',
                'label' => 'kitsoft.core::lang.permissions.manage_sentry'
            ]
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [];
    }

    /*
     * Register twig filters
     */
    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'url' => ['KitSoft\Core\Twig\UrlFilter', 'url'],
                'month' => ['KitSoft\Core\Twig\MonthFilter', 'month'],
                'diffForHumans' => ['KitSoft\Core\Twig\DateFilter', 'diffForHumans'],
            ],
            'functions' => [
                'getPage' => ['KitSoft\Core\Twig\Functions', 'getPage'],
                'getPageByComponent' => ['KitSoft\Core\Twig\Functions', 'getPageByComponent'],
                'getPageByTemplate' => ['KitSoft\Core\Twig\Functions', 'getPageByTemplate'],
                'getTimelinePage' => ['KitSoft\Core\Twig\Functions', 'getTimelinePage'],
                'getTimelinePageUrl' => ['KitSoft\Core\Twig\Functions', 'getTimelinePageUrl'],
            ]
        ];
    }

    public function registerSettings()
    {
        return [
            'robotstxt' => [
                'label'       => 'Robots.txt',
                'description' => '',
                'category'    => 'Core',
                'icon'        => 'icon-globe',
                'class'       => 'KitSoft\Core\Models\RobotsTxt',
                'order'       => 500,
                'permissions' => ['kitsoft.core.manage_robots_txt'],
            ],
            'googleanalytics' => [
                'label'       => 'Google Analytics',
                'description' => '',
                'category'    => 'Core',
                'icon'        => 'icon-globe',
                'class'       => 'KitSoft\Core\Models\GoogleAnalytics',
                'order'       => 501,
                'permissions' => ['kitsoft.core.manage_google_analytics'],
            ],
            // 'settings' => [
            //     'label'       => 'Settings',
            //     'description' => '',
            //     'category'    => 'Core',
            //     'icon'        => 'icon-cogs',
            //     'class'       => 'KitSoft\Core\Models\Settings',
            //     'order'       => 502,
            //     'permissions' => ['kitsoft.core.manage_settings'],
            // ],
            'sentry' => [
                'label'       => 'Sentry',
                'description' => '',
                'category'    => 'Core',
                'icon'        => 'icon-sentry',
                'class'       => 'KitSoft\Core\Models\Sentry',
                'order'       => 501,
                'permissions' => ['kitsoft.core.manage_sentry'],
            ],
            'domainсhanging' => [
                'label'       => 'Domain Changing',
                'description' => '',
                'category'    => 'Core',
                'icon'        => 'icon-cog',
                'class'       => 'KitSoft\Core\Models\DomainChanging',
                'order'       => 503,
                'permissions' => ['kitsoft.core.manage_domain_changing'],
            ]
        ];
    }

    /*
     * registerReportWidgets
     */
    public function registerReportWidgets()
    {
        return [
            'KitSoft\Core\ReportWidgets\GoogleAnalytics' => [
                'label'   => 'Google Analytics Status',
                'context' => 'dashboard'
            ],
            'KitSoft\Core\ReportWidgets\RobotsTxt' => [
                'label'   => 'Robots Txt Status',
                'context' => 'dashboard'
            ]
        ];
    }
}
