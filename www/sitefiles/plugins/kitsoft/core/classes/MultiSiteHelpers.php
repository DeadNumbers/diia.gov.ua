<?php namespace KitSoft\Core\Classes;

use KitSoft\MultiSite\Classes\MultiSite;
use KitSoft\MultiSite\Models\Site;
use System\Classes\PluginManager;

class MultiSiteHelpers
{
    /**
     * site
     */
    public static function site()
    {
        if (!PluginManager::instance()->hasPlugin('KitSoft.MultiSite')) {
            return;
        }

    	return MultiSite::instance()
    		->getCurrentSite();
    }

    /**
     * sites
     */
    public static function sites()
    {
        if (!PluginManager::instance()->hasPlugin('KitSoft.MultiSite')) {
            return;
        }

        return Site::listSites();
    }
}
