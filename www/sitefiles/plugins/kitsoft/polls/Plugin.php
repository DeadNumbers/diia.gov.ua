<?php namespace KitSoft\Polls;

use Backend;
use System\Classes\PluginBase;

/**
 * Polls Plugin Information File
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
            'name'        => 'Polls',
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
            'KitSoft\Polls\Components\Poll' => 'poll',
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
            'kitsoft.polls.polls.index' => [
                'tab' => 'Polls',
                'label' => 'kitsoft.polls::lang.access.manage_polls'
            ],
            'kitsoft.polls.questions.index' => [
                'tab' => 'Polls',
                'label' => 'kitsoft.polls::lang.access.manage_questions'
            ],
            'kitsoft.polls.answers.index' => [
                'tab' => 'Polls',
                'label' => 'kitsoft.polls::lang.access.manage_answers'
            ],
            'kitsoft.polls.departments.index' => [
                'tab' => 'Polls',
                'label' => 'kitsoft.polls::lang.access.manage_departments'
            ],
            'kitsoft.polls.locations.index' => [
                'tab' => 'Polls',
                'label' => 'kitsoft.polls::lang.access.manage_locations'
            ],
            'kitsoft.polls.access_import' => [
                'tab' => 'Polls',
                'label' => 'kitsoft.polls::lang.access.access_import'
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
            'polls' => [
                'label'       => 'kitsoft.polls::lang.plugin.name',
                'url'         => Backend::url('kitsoft/polls/polls'),
                'icon'        => 'icon-pie-chart',
                'permissions' => ['kitsoft.polls.*'],
                'order'       => 450,

                'sideMenu' => [
                    'polls' => [
                        'label'       => 'kitsoft.polls::lang.side_menu.polls',
                        'icon'        => 'icon-pie-chart',
                        'url'         => Backend::url('kitsoft/polls/polls'),
                        'permissions' => ['kitsoft.polls.polls.index']
                    ],

                    'questions' => [
                        'label'       => 'kitsoft.polls::lang.side_menu.questions',
                        'icon'        => 'icon-question-circle',
                        'url'         => Backend::url('kitsoft/polls/questions'),
                        'permissions' => ['kitsoft.polls.questions.index']
                    ],

                    'answers' => [
                        'label'       => 'kitsoft.polls::lang.side_menu.answers',
                        'icon'        => 'icon-align-left',
                        'url'         => Backend::url('kitsoft/polls/answers'),
                        'permissions' => ['kitsoft.polls.answers.index']
                    ],

                    'departments' => [
                        'label'       => 'kitsoft.polls::lang.side_menu.departments',
                        'icon'        => 'icon-university',
                        'url'         => Backend::url('kitsoft/polls/departments'),
                        'permissions' => ['kitsoft.polls.departments.index']
                    ],

                    'locations' => [
                        'label'       => 'kitsoft.polls::lang.side_menu.locations',
                        'icon'        => 'icon-location-arrow',
                        'url'         => Backend::url('kitsoft/polls/locations'),
                        'permissions' => ['kitsoft.polls.locations.index']
                    ]
                ],
            ]
        ];
    }

    /**
     * registerSettings
     */
    public function registerSettings()
    {
        return [];
    }
}
