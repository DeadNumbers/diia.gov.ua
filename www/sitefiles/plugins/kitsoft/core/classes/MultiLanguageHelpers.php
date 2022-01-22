<?php namespace KitSoft\Core\Classes;

use App;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\MultiLanguage\Models\Locale;
use System\Classes\PluginManager;

class MultiLanguageHelpers
{
	/**
     * lang
     */
    public static function lang()
    {
        if (!PluginManager::instance()->hasPlugin('KitSoft.MultiLanguage')) {
            return;
        }

        return MultiLanguage::instance()->getActiveLocale();
    }

    /**
     * langs
     */
    public static function langs()
    {
        if (!PluginManager::instance()->hasPlugin('KitSoft.MultiLanguage')) {
            return;
        }

        return Locale::isEnabled()->get();
    }
}