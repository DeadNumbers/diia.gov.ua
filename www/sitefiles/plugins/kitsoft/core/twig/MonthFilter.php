<?php namespace KitSoft\Core\Twig;

use KitSoft\MultiLanguage\Classes\MultiLanguage;
use System\Classes\PluginManager;
use Request;

class MonthFilter
{
    protected static $ua_date_formats = [
        'бер' => 'берез',
        '{0}травень|{1}травня' => 'трав',
        'тра' => 'трав',
        'вер' => 'верес',
        'лист' => 'листоп',
    ];

    /**
     * @param string $string - date('M')
     * @return string|void
     */
    public static function month($string)
    {
        if (!$string) {
            return;
        }

        if (PluginManager::instance()->hasPlugin('KitSoft.MultiLanguage')) {
            $locale = MultiLanguage::instance()->getActiveLocale();
            if (in_array($locale, ['ua', 'uk'])) {
                return self::$ua_date_formats[$string] ?? $string;
            }
        }

        return $string;
    }

}