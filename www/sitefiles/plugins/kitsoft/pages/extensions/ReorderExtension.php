<?php namespace KitSoft\Pages\Extensions;

use Event;

class ReorderExtension
{
    /*
     * Construct
     */
    public function __construct()
    {
    	Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
            $controller->addCss("/plugins/kitsoft/pages/assets/css/reorder.css", "1.0.0");
            $controller->addJs("/plugins/kitsoft/pages/assets/js/reorder.js", "1.0.0");
        });
    }
}