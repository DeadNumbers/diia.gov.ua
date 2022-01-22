<?php namespace KitSoft\Resizer\Extensions;

use Event;

class MirrorExtension
{
    /*
     * add sitemap links to robots.txt
     */
    public function __construct()
    {
    	Event::listen('system.console.mirror.extendPaths', function ($paths) {
    		$paths->directories[] = 'storage/app/thumbnails';
        });
    }
}