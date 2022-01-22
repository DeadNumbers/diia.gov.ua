<?php namespace KitSoft\RLBlogXT;

use App;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public $require = [
        'KitSoft.Core',
        'KitSoft.Pages',
        'RainLab.Blog'
    ];

    /**
     * pluginDetails
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'RLBlogXT',
            'description' => 'Extension of RainLab Blog Plugin',
            'author'      => 'Maksym Nozhkin',
        ];
    }

    /**
     * register
     */
    public function register() {
        $this->registerConsoleCommand('rlblogxt.import', 'KitSoft\RLBlogXT\Console\Import');
    }

    /**
     * boot
     */
    public function boot()
    {
        App::make('KitSoft\RLBlogXT\Extensions\BlogPostExtension');
        App::make('KitSoft\RLBlogXT\Extensions\PostsListExtension');
        App::make('KitSoft\RLBlogXT\Extensions\NavigationExtension');
        App::make('KitSoft\RLBlogXT\Extensions\BlogCategoryExtension');
    }

    /**
     * registerComponents
     */
    public function registerComponents()
    {
        return [
            'KitSoft\RLBlogXT\Components\Post'         => 'blogPost',
            'KitSoft\RLBlogXT\Components\Posts'        => 'posts',
            'KitSoft\RLBlogXT\Components\MainNews'     => 'mainNews',
            'KitSoft\RLBlogXT\Components\LastNews'     => 'newsLast',
            'KitSoft\RLBlogXT\Components\Category'     => 'blogCategory',
            'KitSoft\RLBlogXT\Components\Categories'   => 'blogCategories',
            'KitSoft\RLBlogXT\Components\PopularNews'  => 'popularNews',
            'KitSoft\RLBlogXT\Components\ExternalNews' => 'externalNews'
        ];
    }

    /**
     * registerPermissions
     */
    public function registerPermissions()
    {
        return [
            'kitsoft.rlblogxt.access_authors' => [
                'tab'   => 'rainlab.blog::lang.blog.tab',
                'label' => 'kitsoft.rlblogxt::lang.rlblogxt.access_authors'
            ],
            'kitsoft.rlblogxt.manage_settings' => [
                'tab'   => 'rainlab.blog::lang.blog.tab',
                'label' => 'kitsoft.rlblogxt::lang.rlblogxt.manage_settings'
            ]
        ];
    }

    /**
     * registerSettings
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Settings',
                'description' => '',
                'category'    => 'rainlab.blog::lang.blog.menu_label',
                'icon'        => 'icon-cogs',
                'class'       => 'KitSoft\RLBlogXT\Models\Settings',
                'order'       => 600,
                'permissions' => ['kitsoft.rlblogxt.manage_settings'],
            ]
        ];
    }
}