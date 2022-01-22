<?php namespace KitSoft\Search;

use App;
use Backend;
use System\Classes\PluginBase;

/**
 * Search Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * required plugins
     * @var array
     */
    public $require = [
        'KitSoft.Pages',
        'KitSoft.Core'
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'kitsoft.search::lang.plugin.name',
            'description' => 'kitsoft.search::lang.plugin.description',
            'author'      => 'KitSoft',
            'icon'        => 'icon-search'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConsoleCommand('search.elastic_enable', 'KitSoft\Search\Console\ElasticEnable');
        $this->registerConsoleCommand('search.elastic_providers', 'KitSoft\Search\Console\ElasticProviders');
        $this->registerConsoleCommand('search.elastic_reindex', 'KitSoft\Search\Console\ElasticReindex');
        $this->registerConsoleCommand('search.elastic_refresh', 'KitSoft\Search\Console\ElasticRefresh');
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        App::make('KitSoft\Search\Extensions\MultiSiteExtension');
        App::make('KitSoft\Search\Extensions\ElasticEventsExtension');

        $this->app->bind('KitSoft\Search\Classes\Interfaces\ElasticClientContract', 'KitSoft\Search\Classes\ElasticClient');
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'KitSoft\Search\Components\Search' => 'search',
            'KitSoft\Search\Components\NpaSearch' => 'searchNpa',
            'KitSoft\Search\Components\NpaHomeSearch' => 'npaHomeSearch'
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
            'kitsoft.search.access_settings' => [
                'tab'   => 'kitsoft.search::lang.permissions.tab',
                'label' => 'kitsoft.search::lang.permissions.access_settings'
            ],
            'kitsoft.search.access_providers_settings' => [
                'tab'   => 'kitsoft.search::lang.permissions.tab',
                'label' => 'kitsoft.search::lang.permissions.access_providers_settings'
            ],
        ];
    }

    /**
     * Registers settings.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Search Settings',
                'description' => '',
                'category'    => 'Search',
                'icon'        => 'icon-search',
                'class'       => 'KitSoft\Search\Models\Settings',
                'order'       => 500,
                'permissions' => ['kitsoft.search.access_settings']
            ],
            'elasticindex' => [
                'label'       => 'Elastic Indexes',
                'description' => '',
                'icon'        => 'icon-upload',
                'url'         => Backend::url('kitsoft/search/elasticindex'),
                'order'       => 501,
                'category'    => 'Search',
                'permissions' => ['kitsoft.search.access_settings']
            ],
            'providers' => [
                'label'       => 'Providers',
                'description' => '',
                'category'    => 'Search',
                'icon'        => 'icon-cogs',
                'class'       => 'KitSoft\Search\Models\ProvidersSettings',
                'order'       => 502,
                'permissions' => ['kitsoft.search.access_providers_settings']
            ],
        ];
    }
}
