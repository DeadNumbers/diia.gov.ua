<?php namespace KitSoft\Diia;

use App;
use Backend;
use System\Classes\PluginBase;
use Validator;

/**
 * Diia Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
        'KitSoft.Services',
        'KitSoft.Faq',
        'KitSoft.Forms'
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Diia',
            'description' => 'No description provided yet...',
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
        App::make('KitSoft\Diia\Extensions\ServicesExtension');
        App::make('KitSoft\Diia\Extensions\DigestExtension');
        Validator::replacer('recaptcha', 'KitSoft\Diia\Validators\Recaptcha@recaptchaMessage');
        Validator::extend('recaptcha', 'KitSoft\Diia\Validators\Recaptcha@recaptcha');
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'KitSoft\Diia\Components\ReCaptcha' => 'reCaptcha',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [];
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
}
