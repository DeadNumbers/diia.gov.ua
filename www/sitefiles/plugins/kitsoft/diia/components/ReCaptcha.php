<?php namespace KitSoft\Diia\Components;

use ValidationException;
use Cms\Classes\ComponentBase;
use KitSoft\Forms\Models\Settings;

class ReCaptcha extends ComponentBase
{
    public $recaptcha;

    public function componentDetails()
    {
        return [
            'name'        => 'ReCaptcha',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->recaptcha = $this->loadRecaptcha();
    }

    /**
     * loadRecaptcha
     */
    protected function loadRecaptcha()
    {
        return [
            'site_key' => Settings::get('site_key'),
            'lang'     => Settings::get('lang')
        ];
    }
}