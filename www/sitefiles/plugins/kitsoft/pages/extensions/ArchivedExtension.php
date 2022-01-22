<?php namespace KitSoft\Pages\Extensions;

use Event;
use Config;
use KitSoft\Pages\Controllers\Pages;
use KitSoft\Pages\Models\Page;

class ArchivedExtension
{    
    /*
     * Construct
     */
    public function __construct()
    {
        if (!Config::get('kitsoft.pages::enableArchive')) {
            return;
        }

        Page::extend(function ($model) {
            $model->implement[] = 'KitSoft.Pages.Behaviors.ArchivedModel';
        });

        Pages::extend(function ($controller) {
            $controller->implement[] = 'KitSoft.Pages.Behaviors.ArchivedController';
        });

        Event::listen('kitsoft::controller.beforeConstruct', function ($controller) {
            if (request()->has('archived')) {
                $controller->listConfig = $controller->makeConfig('config_list_archived.yaml');
            }
        });
    }
}
