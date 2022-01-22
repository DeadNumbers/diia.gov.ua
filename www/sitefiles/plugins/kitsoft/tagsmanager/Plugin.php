<?php namespace KitSoft\TagsManager;

use App;
use Backend\Facades\Backend;
use KitSoft\TagsManager\Components\PopularTags;
use KitSoft\TagsManager\Components\TagPage;
use KitSoft\TagsManager\Models\Tag;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public $require = [
        'KitSoft.Core'
    ];

    /**
     * pluginDetails
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Tags Manager',
            'description' => 'The KitSoft Manager of Tags',
            'author'      => 'Nozhkin Maksym',
            'icon'        => 'icon-tags',
        ];
    }

    /**
     * registerNavigation
     */
    public function registerNavigation()
    {
        return [
            'Manager' => [
                'label' => 'kitsoft.tagsmanager::lang.tag.tagmanager',
                'url'   => Backend::url('kitsoft/tagsmanager/tags'),
                'icon'  => 'icon-tags',
                'order' => 300,
                'permissions' => ['kitsoft.tagsmanager.*'],
                'sideMenu' => [
                    'newTag' => [
                        'label' => 'kitsoft.tagsmanager::lang.tag.new_tag',
                        'icon'  => 'icon-plus',
                        'url'   => Backend::url('kitsoft/tagsmanager/tags/create'),
                        'permissions' => ['kitsoft.tagsmanager.access_tags']
                    ],
                    'Tags' => [
                        'label' => 'kitsoft.tagsmanager::lang.tag.name',
                        'icon'  => 'icon-tags',
                        'url'   => Backend::url('kitsoft/tagsmanager/tags'),
                        'permissions' => ['kitsoft.tagsmanager.access_tags']
                    ],
                ],
            ],
        ];
    }

    /**
     * boot
     */
    public function boot()
    {
        App::make('KitSoft\TagsManager\Extensions\PluginsExtension');
        App::make('KitSoft\TagsManager\Extensions\RainLabPagesExtension');
    }

    /**
     * registerComponents
     */
    public function registerComponents()
    {
        return [
            TagPage::class     => 'tagPage',
            PopularTags::class => 'popularTags',
        ];
    }

    /**
     * registerPermissions
     */
    public function registerPermissions()
    {
        return [
            'kitsoft.tagsmanager.access_tags' => [
                'tab'   => 'kitsoft.tagsmanager::lang.access.tab',
                'label' => 'kitsoft.tagsmanager::lang.access.label'
            ],
        ];
    }


    /*
     * Register twig filters
     */
    public function registerMarkupTags()
    {
        return [
            'functions' => [
                'tagLink'         => ['KitSoft\TagsManager\Twig\Functions', 'tagLink'],
                'tagLinkTimeline' => ['KitSoft\TagsManager\Twig\Functions', 'tagLinkTimeline']
            ]
        ];
    }
}
