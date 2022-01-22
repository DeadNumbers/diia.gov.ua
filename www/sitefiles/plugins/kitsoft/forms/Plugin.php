<?php namespace KitSoft\Forms;

use Backend;
use KitSoft\Forms\Models\Inbox;
use System\Classes\PluginBase;
use Validator;

/**
 * Forms Plugin Information File
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
            'name'        => 'kitsoft.forms::lang.plugin.name',
            'description' => 'kitsoft.forms::lang.plugin.description',
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
        Validator::replacer('recaptcha', 'KitSoft\Forms\Validators\Recaptcha@recaptchaMessage');
        Validator::extend('recaptcha', 'KitSoft\Forms\Validators\Recaptcha@recaptcha');
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'KitSoft\Forms\Components\Form' => 'form',
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
            'kitsoft.forms.manage_forms' => [
                'tab'   => 'kitsoft.forms::lang.permissions.tabs.forms',
                'label' => 'kitsoft.forms::lang.permissions.permissions.manage_forms'
            ],
            'kitsoft.forms.manage_inbox' => [
                'tab'   => 'kitsoft.forms::lang.permissions.tabs.forms',
                'label' => 'kitsoft.forms::lang.permissions.permissions.manage_inbox'
            ],
            'kitsoft.forms.access_settings' => [
                'tab'   => 'kitsoft.forms::lang.permissions.tabs.forms',
                'label' => 'kitsoft.forms::lang.permissions.permissions.access_settings'
            ]
        ];
    }

    /**
     * registerSettings
     */
    public function registerSettings()
    {
        return [
            'inbox' => [
                'label'       => 'kitsoft.forms::lang.settings_menu.menu.inbox',
                'description' => '',
                'icon'        => 'icon-envelope',
                'url'         => Backend::url('kitsoft/forms/inboxes'),
                'order'       => 1,
                'category'    => 'kitsoft.forms::lang.settings_menu.tabs.forms',
                'permissions' => ['kitsoft.forms.manage_inbox'],
                'counter'     => Inbox::getUnreadedInboxCount()
            ],
            'forms' => [
                'label'       => 'kitsoft.forms::lang.settings_menu.menu.forms',
                'description' => '',
                'icon'        => 'icon-list-ol',
                'url'         => Backend::url('kitsoft/forms/forms'),
                'order'       => 2,
                'category'    => 'kitsoft.forms::lang.settings_menu.tabs.forms',
                'permissions' => ['kitsoft.forms.manage_forms']
            ],
            'settings' => [
                'label'       => 'kitsoft.forms::lang.settings_menu.menu.settings',
                'description' => '',
                'icon'        => 'icon-cogs',
                'class'       => 'KitSoft\Forms\Models\Settings',
                'category'    => 'kitsoft.forms::lang.settings_menu.tabs.forms',
                'order'       => 3,
                'permissions' => ['kitsoft.forms.access_settings'],
            ]
        ];
    }

    /**
     * registerReportWidgets
     */
    public function registerReportWidgets()
    {
        return [
            'KitSoft\Forms\ReportWidgets\UnreadedInboxes' => [
                'label'   => 'kitsoft.forms::lang.widgets.unreaded_inboxes.name',
                'context' => 'dashboard'
            ]
        ];
    }
}
