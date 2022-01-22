<?php namespace KitSoft\Core\Components;

use Kitsoft\Core\Models\GoogleAnalytics as GoogleAnalyticsSettings;
use Cms\Classes\ComponentBase;
use KitSoft\Core\Classes\MultiSiteHelpers;

class GoogleAnalytics extends ComponentBase
{
    public $code;
    public $type;
    public $domains;
    public $interdomainTracking;

    /**
     * componentDetails
     */
    public function componentDetails()
    {
        return [
            'name'        => 'Google Analytics',
            'description' => ''
        ];
    }

    /**
     * defineProperties
     */
    public function defineProperties()
    {
        return [];
    }

    /**
     * onRun
     */
    public function onRender()
    {
        $settings = GoogleAnalyticsSettings::instance();
        $this->type = $settings->type;
        $this->code = $settings->enabledCode;
        $this->domains = $this->loadDomains();
        $this->interdomainTracking = $settings->interdomainTracking;
    }

    /**
     * loadDomains
     */
    public function loadDomains()
    {
        if (!$sites = MultiSiteHelpers::sites()) {
            return;
        }

        return $sites->map(function($item) {
            return parse_url($item->domain, PHP_URL_HOST);
        });
    }
}