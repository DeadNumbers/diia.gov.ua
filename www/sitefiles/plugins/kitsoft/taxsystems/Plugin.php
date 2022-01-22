<?php namespace KitSoft\TaxSystems;

use Backend;
use System\Classes\PluginBase;

/**
 * TaxSystems Plugin Information File
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
            'name'        => 'TaxSystems',
            'description' => 'Tax Systems',
            'author'      => 'KitSoft',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'KitSoft\TaxSystems\Components\TaxSystem' => 'taxSystem',
            'KitSoft\TaxSystems\Components\TaxSystems' => 'taxSystems',
            'KitSoft\TaxSystems\Components\TaxSystemChoise' => 'taxSystemChoise'
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
            'kitsoft.taxsystems.taxsystems.index' => [
                'tab' => 'ФОП',
                'label' => 'Tax Systems'
            ],
            'kitsoft.taxsystems.entrepreneurquestions.index' => [
                'tab' => 'ФОП',
                'label' => 'Entrepreneur Questions'
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
            'taxsystems' => [
                'label'       => 'ФОП',
                'url'         => Backend::url('kitsoft/taxsystems/taxsystems'),
                'icon'        => 'icon-book',
                'permissions' => ['kitsoft.taxsystems.*'],
                'order'       => 500,

                'sideMenu' => [
                    'taxsystems' => [
                        'label'       => 'Cистеми оподаткування',
                        'icon'        => 'icon-book',
                        'url'         => Backend::url('kitsoft/taxsystems/taxsystems'),
                        'permissions' => ['kitsoft.taxsystems.taxsystems.index']
                    ],
                    'entrepreneurquestions' => [
                        'label'       => 'Запитання',
                        'icon'        => 'icon-question-circle',
                        'url'         => Backend::url('kitsoft/taxsystems/entrepreneurquestions'),
                        'permissions' => ['kitsoft.taxsystems.entrepreneurquestions.index']
                    ],
                ]
            ],
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
            'kitsoft.taxsystems::taxsystems.taxsystem_pdf' => 'Send pdf of taxsystem.',
        ];
    }
}
