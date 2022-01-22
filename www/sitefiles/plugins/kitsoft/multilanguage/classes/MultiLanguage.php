<?php namespace KitSoft\MultiLanguage\Classes;

use App;
use Jenssegers\Date\Date;
use KitSoft\MultiLanguage\Classes\Interfaces\MultiLanguageInterface;
use KitSoft\MultiLanguage\Models\Locale;
use Request;
use Route;

/**
 * MultiLanguage
 */
class MultiLanguage implements MultiLanguageInterface
{
    use \October\Rain\Support\Traits\Singleton;

    protected $activeLocale;
    protected $defaultLocale;

    /**
     * Initialize the singleton
     */
    public function init()
    {
        $this->setLocale();
    }

    /**
     * setLocale
     * public for console commands
     */
    public function setLocale($locale = null)
    {
        $this->defaultLocale = Locale::getDefault();

        if (!$locale) {
            $locale = $this->loadActiveLocale();
        }

        if (!Locale::isValid($locale)) {
            return;
        }

        $this->activeLocale = $locale;

        // change locale use a lot of memory, disable it for console
        if (!App::runningInConsole()) {
            $localeCode = $this->getExternalActiveLocale($locale);
            App::setLocale($localeCode);
            Date::setLocale($localeCode);
        }
    }

    /**
     * getDefaultLocale
     */
    public function getDefaultLocale()
    {
        return $this->defaultLocale;
    }

    /**
     * getActiveLocale
     */
    public function getActiveLocale()
    {
        return $this->activeLocale;
    }

    /**
     * getExternalActiveLocale
     */
    public function getExternalActiveLocale($locale = null)
    {
        $locale = $locale ?? $this->getActiveLocale();

        switch ($locale) {
            case 'ua':
                $locale = 'uk';
                break;
        }

        return $locale;
    }

    /**
     * isLocalizedRoute
     */
    public function isLocalizedRoute()
    {
        return array_has(Route::current()->action, 'multilanguage');
    }

    /**
     * isDefault
     */
    public function isDefault()
    {
        return (boolean)($this->getActiveLocale() == $this->defaultLocale);
    }

    /**
     * loadActiveLocale
     */
    protected function loadActiveLocale()
    {
        if ($locale = Request::get('lang')) {
            return $locale;
        }

        if (App::runningInBackend()) {
            return $_COOKIE['backendLocale'] ?? $this->defaultLocale;
        }

        if ($locale = $this->loadLocaleFromRequest()) {
            return $locale;
        }

        return $this->defaultLocale;
    }

    /**
     * loadLocaleFromRequest
     */
    public function loadLocaleFromRequest()
    {
        $locale = Request::segment(1);
        $locales = Locale::listEnabled();

        if (!array_key_exists($locale, $locales)) {
            return false;
        }

        return $locale;
    }
}
