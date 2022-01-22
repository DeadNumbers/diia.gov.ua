<?php namespace KitSoft\Pages\Extensions;

use Event;
use Config;
use KitSoft\Pages\Controllers\Pages;
use KitSoft\Pages\Models\Page;

class TrashedExtension
{
    /*
     * Construct
     */
    public function __construct()
    {
        if (!Config::get('kitsoft.pages::enableTrash')) {
            return;
        }

        Pages::extend(function ($controller) {
            $controller->implement[] = 'KitSoft.Pages.Behaviors.TrashedController';
        });

        Event::listen('kitsoft::controller.beforeConstruct', function ($controller) {
            if (request()->has('trashed')) {
                $controller->listConfig = $controller->makeConfig('config_list_trashed.yaml');
            }
        });
    }
}
