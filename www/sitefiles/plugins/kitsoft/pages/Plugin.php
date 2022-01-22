<?php namespace KitSoft\Pages;

use App;
use Backend;
use Backend\Classes\WidgetManager;
use Config;
use Event;
use KitSoft\Pages\Classes\ComponentFields;
use KitSoft\Pages\Classes\Controller;
use System\Classes\PluginBase;
use Validator;

/**
 * Pages Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'kitsoft.pages::lang.plugin.name',
            'description' => 'kitsoft.pages::lang.plugin.description',
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
        $this->registerConsoleCommand(
            'pages:importrainlabpages',
            'KitSoft\Pages\Console\ImportRainLabStaticPages'
        );

        $this->registerConsoleCommand(
            'pages:importrainlabmenu',
            'KitSoft\Pages\Console\ImportRainLabMenu'
        );

        // FormWidgets
        WidgetManager::instance()->registerFormWidgets(function ($manager) {
            $manager->registerFormWidget('KitSoft\Pages\FormWidgets\RelationFinder', [
                'label' => 'Relation Finder',
                'code'  => 'relationfinder'
            ]);

            $manager->registerFormWidget('KitSoft\Pages\FormWidgets\FileUpload', [
                'label' => 'MultiMediaFinder',
                'code'  => 'multimediafinder'
            ]);

            $manager->registerFormWidget('KitSoft\Pages\FormWidgets\OpenStreetMap', [
                'label' => 'OpenStreetMap',
                'code'  => 'openstreetmap'
            ]);
        });
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        Event::listen('cms.router.beforeRoute', function ($url, $controller) {
            return Controller::instance()->initCmsPage($url, $controller);
        });

        App::make('KitSoft\Pages\Extensions\ConfigExtension');
        App::make('KitSoft\Pages\Extensions\ReorderExtension');
        App::make('KitSoft\Pages\Extensions\CheckboxListExtension');
        App::make('KitSoft\Pages\Extensions\SectionsFieldsExtension');
        App::make('KitSoft\Pages\Extensions\ComponentsFieldsExtension');
        App::make('KitSoft\Pages\Extensions\PartialsFieldsExtension');
        App::make('KitSoft\Pages\Extensions\PagesFieldsExtension');
        App::make('KitSoft\Pages\Extensions\TrashedExtension');
        App::make('KitSoft\Pages\Extensions\ArchivedExtension');
        App::make('KitSoft\Pages\Extensions\ValidatorsExtension');
        App::make('KitSoft\Pages\Extensions\SettingsControllerExtension');
        App::make('KitSoft\Pages\Extensions\StorageExtension');
        App::make('KitSoft\Pages\Extensions\BackendControllerFiltersExtension');

        // hide CMS menu
        Event::listen('backend.menu.extendItems', function ($navigationManager) {
            if (!Config::get('kitsoft.pages::routingByPages')) {
                return;
            }
            $navigationManager->removeMainMenuItem('October.Cms', 'cms');
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'KitSoft\Pages\Components\Page' => 'page',
            'KitSoft\Pages\Components\Menu' => 'menu',
            'KitSoft\Pages\Components\LastPages' => 'lastPages'
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
            'kitsoft.pages.pages.create' => [
                'tab' => 'kitsoft.pages::lang.plugin.name',
                'label' => 'kitsoft.pages::lang.permissions.pages.create'
            ],
            'kitsoft.pages.pages.delete' => [
                'tab' => 'kitsoft.pages::lang.plugin.name',
                'label' => 'kitsoft.pages::lang.permissions.pages.delete'
            ],
            'kitsoft.pages.pages.is_system.fields' => [
                'tab' => 'kitsoft.pages::lang.plugin.name',
                'label' => 'kitsoft.pages::lang.permissions.pages.isSystemFields'
            ],
            'kitsoft.pages.pages.index' => [
                'tab' => 'kitsoft.pages::lang.plugin.name',
                'label' => 'kitsoft.pages::lang.permissions.pages.index'
            ],
            'kitsoft.pages.menu.index' => [
                'tab' => 'kitsoft.pages::lang.plugin.name',
                'label' => 'kitsoft.pages::lang.permissions.menu.index'
            ],
            'kitsoft.pages.menu.create' => [
                'tab' => 'kitsoft.pages::lang.plugin.name',
                'label' => 'kitsoft.pages::lang.permissions.menu.create'
            ],
            'kitsoft.pages.partials.index' => [
                'tab' => 'kitsoft.pages::lang.plugin.name',
                'label' => 'kitsoft.pages::lang.permissions.partials.index'
            ],
            'kitsoft.pages.partials.create' => [
                'tab' => 'kitsoft.pages::lang.plugin.name',
                'label' => 'kitsoft.pages::lang.permissions.partials.create'
            ],
            'kitsoft.pages.components.create' => [
                'tab' => 'kitsoft.pages::lang.plugin.name',
                'label' => 'kitsoft.pages::lang.permissions.components.create'
            ],
            'kitsoft.pages.sections.create' => [
                'tab' => 'kitsoft.pages::lang.plugin.name',
                'label' => 'kitsoft.pages::lang.permissions.sections.create'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'pages' => [
                'label'       => 'kitsoft.pages::lang.pages.name',
                'url'         => Backend::url('kitsoft/pages/pages'),
                'icon'        => 'icon-files-o',
                'permissions' => ['kitsoft.pages.*'],
                'order'       => 100,

                'sideMenu' => [
                    'newpage' => [
                        'label'       => 'kitsoft.pages::lang.pages.create',
                        'icon'        => 'icon-plus',
                        'url'         => Backend::url('kitsoft/pages/pages/create'),
                        'permissions' => ['kitsoft.pages.pages.create']
                    ],

                    'pages' => [
                        'label'       => 'kitsoft.pages::lang.pages.name',
                        'icon'        => 'icon-copy',
                        'url'         => Backend::url('kitsoft/pages/pages'),
                        'permissions' => ['kitsoft.pages.pages.index']
                    ],

                    'menus' => [
                        'label'       => 'kitsoft.pages::lang.menu.name',
                        'icon'        => 'icon-bars',
                        'url'         => Backend::url('kitsoft/pages/menus'),
                        'permissions' => ['kitsoft.pages.menu.index']
                    ],

                    'partials' => [
                        'label'       => 'kitsoft.pages::lang.partials.name',
                        'icon'        => 'icon-bars',
                        'url'         => Backend::url('kitsoft/pages/partials'),
                        'permissions' => ['kitsoft.pages.partials.index']
                    ]
                ],
            ]
        ];
    }

    /*
     * registerSchedule
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Pages',
                'description' => '',
                'category'    => 'Pages',
                'icon'        => 'icon-copy',
                'class'       => 'KitSoft\Pages\Models\Settings',
                'order'       => 500,
            ]
        ];
    }

    /*
     * registerSchedule
     */
    public function registerSchedule($schedule)
    {
        $schedule->call(function() {
            App::make('KitSoft\Pages\Schedulers\CleanTrash');
        })->dailyAt('08:00');
    }

    /*
     * Register twig filters
     */
    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'pageLink' => ['KitSoft\Pages\Twig\Filters', 'pageLink'],
                'relationFinder' => ['KitSoft\Pages\Twig\Filters', 'relationFinder'],
                'argon' => ['KitSoft\Pages\Twig\Filters', 'argon'],
            ],
            'functions' => [
                'partial' => ['KitSoft\Pages\Twig\Functions', 'partial']
            ]
        ];
    }
}
