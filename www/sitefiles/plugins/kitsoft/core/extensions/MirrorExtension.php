<?php namespace KitSoft\Core\Extensions;

use Event;

class MirrorExtension
{
    /*
     * add sitemap links to robots.txt
     */
    public function __construct()
    {
    	Event::listen('system.console.mirror.extendPaths', function ($paths) {
    		$paths->wildcards[] = 'plugins/*/*/behaviors/*';
    		$paths->wildcards[] = 'plugins/*/*/extensions/*/assets';
        });
    }
}