<?php namespace KitSoft\Sitemap\Extensions;

use Event;
use KitSoft\Sitemap\Classes\Helpers;

class RobotsTxtExtension
{
    /*
     * add sitemap links to robots.txt
     */
    public function __construct()
    {
    	Event::listen('kitsoft.core::extendRobotsTxt', function (&$content) {
            $content .= "\r\n\r\n";
            $content .= Helpers::getBuilder()->getRobotsTxtContent();
        });
    }
}