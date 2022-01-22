<?php namespace KitSoft\Pages\Extensions;

use Event;

class CheckboxListExtension
{
    /*
     * Construct
     */
    public function __construct()
    {
    	Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
            $controller->addCss("/plugins/kitsoft/pages/assets/css/checkboxlist.css", "1.0.0");
            $controller->addJs("/plugins/kitsoft/pages/assets/js/checkboxlist.js", "1.0.0");
        });
    }
}