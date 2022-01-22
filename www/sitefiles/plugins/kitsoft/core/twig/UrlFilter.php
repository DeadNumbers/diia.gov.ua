<?php namespace KitSoft\Core\Twig;

use KitSoft\MultiLanguage\Classes\UrlGenerator;
use System\Classes\PluginManager;

class UrlFilter {
	/**
	 * url
	 */
	public static function url($string) {
		if (!$string) {
			return;
		}

		if (PluginManager::instance()->hasPlugin('KitSoft.MultiLanguage')) {
            $string = UrlGenerator::getLocalizedUrl($string);
        }

        return $string;
	}	
}