<?php namespace KitSoft\MultiLanguage\Twig;

use Route;
use Request;
use KitSoft\MultiLanguage\Classes\MultiLanguage;

class Functions
{
    /**
     * getActiveLocale
     */
    public static function getActiveLocale()
    {
        return MultiLanguage::instance()->getActiveLocale();
    }

    /**
     * getDefaultLocale
     */
    public static function getDefaultLocale()
    {
        return MultiLanguage::instance()->getDefaultLocale();
    }

    /**
     * renderCanonicalUrl
     */
    public static function renderCanonicalUrl()
    {
        if (!MultiLanguage::instance()->isDefault()) {
            return;
        }

        $path = Route::current()->slug ?? '/';

        if ($query = Request::getQueryString()) {
            $path .= '?' . $query;
        }

        return sprintf('<link rel="canonical" href="%s"/>', url($path));        
    }
}
