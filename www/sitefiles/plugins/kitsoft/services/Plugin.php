<?php namespace KitSoft\Services;

use App;
use Backend;
use System\Classes\PluginBase;

/**
 * Services Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
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
            'name'        => 'Services',
            'description' => 'Services Plugin',
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
        
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'KitSoft\Services\Components\Service' => 'service',
            'KitSoft\Services\Components\Categories' => 'servicesCategories',
            'KitSoft\Services\Components\ServicesByLetter' => 'servicesByLetter',
            'KitSoft\Services\Components\TopServices' => 'topServices',
            'KitSoft\Services\Components\SubCategories' => 'subCategories',
            'KitSoft\Services\Components\Category' => 'serviceCategory',
            'KitSoft\Services\Components\CategorySubcategory' => 'serviceCategorySubcategory',
            'KitSoft\Services\Components\LifeSituation' => 'lifeSituation',
            'KitSoft\Services\Components\SubCategoriesLifeSituations' => 'subCategoriesLifeSituations',
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
            'kitsoft.services.services' => [
                'tab' => 'kitsoft.services::lang.permissions.tab',
                'label' => 'kitsoft.services::lang.permissions.services'
            ],
            'kitsoft.services.categories' => [
                'tab' => 'kitsoft.services::lang.permissions.tab',
                'label' => 'kitsoft.services::lang.permissions.categories'
            ],
            'kitsoft.services.subcategories' => [
                'tab' => 'kitsoft.services::lang.permissions.tab',
                'label' => 'kitsoft.services::lang.permissions.subcategories'
            ],
            'kitsoft.services.access_publish' => [
                'tab' => 'kitsoft.services::lang.permissions.tab',
                'label' => 'kitsoft.services::lang.permissions.access_publish'
            ],
            'kitsoft.services.lifesituations' => [
                'tab' => 'kitsoft.services::lang.permissions.tab',
                'label' => 'kitsoft.services::lang.permissions.lifesituations'
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
        return [
            'services' => [
                'label'       => 'kitsoft.services::lang.plugin.name',
                'url'         => Backend::url('kitsoft/services/services'),
                'icon'        => 'icon-th-list',
                'permissions' => ['kitsoft.services.services'],
                'order'       => 500,
                'sideMenu' => [
                    'services' => [
                        'label' => 'kitsoft.services::lang.services.title',
                        'icon' => 'icon-th-list',
                        'url' => Backend::url('kitsoft/services/services'),
                        'permissions' => ['kitsoft.services.services']
                    ],
                    'categories' => [
                        'label' => 'kitsoft.services::lang.categories.title',
                        'icon' => 'icon-bars',
                        'url' => Backend::url('kitsoft/services/categories'),
                        'permissions' => ['kitsoft.services.categories']
                    ],
                    'subcategories' => [
                        'label' => 'kitsoft.services::lang.subcategories.title',
                        'icon' => 'icon-bars',
                        'url' => Backend::url('kitsoft/services/subcategories'),
                        'permissions' => ['kitsoft.services.subcategories']
                    ],
                    'lifesituations' => [
                        'label' => 'kitsoft.services::lang.life_situations.title',
                        'icon' => 'icon-users',
                        'url' => Backend::url('kitsoft/services/lifesituations'),
                        'permissions' => ['kitsoft.services.lifesituations']
                    ],
                ]
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
            'settings' => [
                'label'       => 'Settings',
                'description' => '',
                'icon'        => 'icon-cogs',
                'class'       => 'KitSoft\Services\Models\Settings',
                'order'       => 552,
                'category'    => 'Services',
                'permissions' => ['kitsoft.services.manage_settings']
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
            'kitsoft.services::services.service_form' => 'Send service email.',
            'kitsoft.services::services.service_pdf' => 'Send pdf of service.',
            'kitsoft.services::services.service_info' => 'Send info of service.',
        ];
    }
}
