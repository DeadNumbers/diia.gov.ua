<?php

namespace KitSoft\MultiLanguage\Extensions;

use App;
use Event;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\MultiLanguage\Models\Locale;
use Redirect;
use Request;

class BackendMlExtension
{
    /**
     * __construct
     */
    public function __construct()
    {
        if (!App::runningInBackend()) {
            return;
        }

        $this->setLocaleCookie();
        $this->registerLocaleSwitcher();
    }

    /**
     * setLocaleCookie
     */
    protected function setLocaleCookie()
    {
        $locale = MultiLanguage::instance()->getActiveLocale();
        setcookie('backendLocale', $locale, null, '/');
    }

    /**
     * registerLocaleSwitcher
     */
    protected function registerLocaleSwitcher()
    {
        Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {

            // ajax handler, on switch locale, set cookie & redirect
            $controller->addDynamicMethod('onSwitchLocale', function () {
                if (!$locale = post('locale')) {
                    return;
                }
                setcookie('backendLocale', $locale, null, '/');

                return Redirect::to(post('redirect') ?: Request::url());
            });

            // add locale switcher to header
            $controller->addJs('/plugins/kitsoft/multilanguage/assets/js/backendLocaleSwitcher.js');
            $controller->addCss('/plugins/kitsoft/multilanguage/assets/css/multilanguage.css');
        });
    }
}
