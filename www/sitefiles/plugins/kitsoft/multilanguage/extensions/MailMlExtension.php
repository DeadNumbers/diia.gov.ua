<?php namespace KitSoft\Multilanguage\Extensions;

use System\Models\MailTemplate;
use System\Controllers\MailTemplates;
use System\Models\MailLayout;
use System\Controllers\MailLayouts;
use System\Models\MailPartial;
use System\Controllers\MailPartials;
use System\Models\MailBrandSetting;

class MailMlExtension
{
    protected $modelImplementClass = 'KitSoft.MultiLanguage.Behaviors.MultiLanguageModel';
    protected $controllerImplementClass = 'KitSoft.MultiLanguage.Behaviors.MultiLanguageController';
    protected $settingsModelImplementClass = 'KitSoft.MultiLanguage.Behaviors.MultiLanguageSettingsModel';

    /*
     * Construct
     */
	public function __construct() {
        
        // MailTemplate
        MailTemplate::extend(function($model) {
            $model->implement[] = $this->modelImplementClass;
        });
        MailTemplates::extend(function($controller) {
            $controller->implement[] = $this->controllerImplementClass;
        });

        // MailLayout
        MailLayout::extend(function($model) {
            $model->implement[] = $this->modelImplementClass;
        });
        MailLayouts::extend(function($controller) {
            $controller->implement[] = $this->controllerImplementClass;
        });
        
        // MailPartial
        MailPartial::extend(function($model) {
            $model->implement[] = $this->modelImplementClass;
        });
        MailPartials::extend(function($controller) {
            $controller->implement[] = $this->controllerImplementClass;
        });

        // MailBrandSetting
        MailBrandSetting::extend(function($model) {
            $model->implement[] = $this->settingsModelImplementClass;
        });
	}
}