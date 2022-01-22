<?php namespace KitSoft\MultiLanguage\Components;

use Cms\Classes\ComponentBase;
use Event;
use KitSoft\MultiLanguage\Classes\MultiLanguage as ML;
use KitSoft\MultiLanguage\Classes\UrlGenerator;
use KitSoft\MultiLanguage\Models\Locale;
use October\Rain\Router\Router as RainRouter;
use Redirect;
use Request;

class MultiLanguage extends ComponentBase
{
    /**
     * @var KitSoft\Translate\Classes\Translator Translator object.
     */
    protected $ml;

    /**
     * @var array Collection of enabled locales.
     */
    public $locales;

    /**
     * @var array Collection of locale links.
     */
    public $links;

    /**
     * @var string The active locale code.
     */
    public $activeLocale;

    public function componentDetails()
    {
        return [
            'name'        => 'kitsoft.multilanguage::lang.component.name',
            'description' => 'kitsoft.multilanguage::lang.component.description',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function init()
    {
        $this->ml = ML::instance();
    }

    /**
     * Redirect to localized url, if request is not ajax or already localized
     */
    public function onRun()
    {
        if ($this->ml->isDefault() && $this->ml->loadLocaleFromRequest()) {
            return Redirect::to(UrlGenerator::getUnlocalizedUrl(Request::fullUrl()), 301);
        }

        $this->activeLocale = $this->ml->getActiveLocale(); 
        $this->locales = Locale::listEnabled('label');
        
        Event::fire('kitsoft.multilanguage::component.ml.links', [&$this->links]);
    }

    /**
     * Ajax. On switch locale redirect
     */
    public function onSwitchLocale()
    {
        if (!$locale = post('locale')) {
            return;
        }

        $this->ml->setLocale($locale);

        return Redirect::to(UrlGenerator::getLocalizedUrl(post('url'), $locale));
    }
}
