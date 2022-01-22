<?php namespace KitSoft\Sitemap\Classes;

use KitSoft\Sitemap\Builders\MultiLangBuilder;
use KitSoft\Sitemap\Builders\MultiLangMultiSiteBuilder;
use KitSoft\Sitemap\Builders\MultiSiteBuilder;
use KitSoft\Sitemap\Builders\SingleSiteBuilder;
use System\Classes\PluginManager;

/**
 * Helpers
 */
class Helpers
{
	/**
	 * getBuilder
	 */
	public static function getBuilder()
	{
		$msPlugin = PluginManager::instance()->hasPlugin('KitSoft.MultiSite');
        $mlPlugin = PluginManager::instance()->hasPlugin('KitSoft.MultiLanguage');

        if ($msPlugin && $mlPlugin) {
            return new MultiLangMultiSiteBuilder();
        }

        if ($mlPlugin) {
            return new MultiLangBuilder();
        }

        if ($msPlugin) {
            return new MultiSiteBuilder();
        }

        return new SingleSiteBuilder();
	}
}