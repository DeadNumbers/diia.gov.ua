<?php namespace KitSoft\MultiLanguage\Extensions;

use Event;
use KitSoft\MultiLanguage\Classes\UrlGenerator;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use Model;

class RelationFinderExtension
{
    protected $currentLocale;
    protected $differentLocales;

    /**
     * __construct
     */
    public function __construct()
    {
        // reinit locale for generate url inside model environment
        Event::listen('kitsoft.pages::relationFinder.beforeGetUrl', function (Model $model) {
            $locale = $model->locale ?? $model->lang->locale;

            $this->differentLocales = false;
            $this->currentLocale = MultiLanguage::instance()->getActiveLocale();

            if ($locale && ($this->currentLocale !== $locale)) {
                $this->differentLocales = true;
                MultiLanguage::instance()->setLocale($locale);
            }
        }, 1);

        // set locale prefix inside model environment
        Event::listen('kitsoft.pages::relationFinder.beforeSetHost', function (Model $model, &$url) {
            $locale = $model->locale ?? $model->lang->locale;

            if (MultiLanguage::instance()->getDefaultLocale() == $locale) {
                return;
            }

            $url = "/{$locale}{$url}";
        }, 1);

        // reinit locale to current environment
        Event::listen('kitsoft.pages::relationFinder.afterGetUrl', function (Model $model, &$url) {
            if (!$this->differentLocales) {
                return;
            }
            MultiLanguage::instance()->setLocale($this->currentLocale);
        }, 1);
    }
}
