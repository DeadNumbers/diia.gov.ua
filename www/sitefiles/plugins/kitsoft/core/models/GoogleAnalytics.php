<?php namespace KitSoft\Core\Models;

use Model;
use System\Classes\PluginManager;

/**
 * GoogleAnalytics Model
 */
class GoogleAnalytics extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = [
        '@KitSoft.MultiSite.Behaviors.MultiSiteSettingsModel',
        '@KitSoft.Revisions.Behaviors.RevisionsModel',
        'System.Behaviors.SettingsModel'
    ];

    // A unique code
    public $settingsCode = 'kitsoft_core_google_analytics';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public $rules = [];

    public function getTypeOptions(){
        return [
            'ga' => 'Google Analytics',
            'gtm' => 'Google Tag Manager'
        ];
    }

    /**
     * getEnabledCodeAttribute
     */
    public function getEnabledCodeAttribute()
    {
        switch ($this->type) {
            case 'ga':
                $code = $this->code;
                break;
            case 'gtm':
                $code = $this->codeGTM;
                break;
            default:
                $code = null;
                break;
        }

        return $code;
    }

    /**
     * getFieldConfig
     */
    public function getFieldConfig()
    {
        $fields = $this->makeConfig($this->settingsFields);

        $fields = $this->addInterdomainTrackingField($fields);

        return $fields;
    }

    /**
     * addInterdomainTrackingField
     */
    protected function addInterdomainTrackingField($fields)
    {
        if (PluginManager::instance()->hasPlugin('KitSoft.MultiSite')) {
            $fields->tabs['fields']['interdomainTracking'] = [
                'label' => 'Використовути міждоменне стеження',
                'span' => 'auto',
                'type' => 'checkbox',
                'tab' => 'kitsoft.core::lang.app.GA',
                'commentHtml' => 'true',
                'comment' => 'Міждоменне стеження Google Analytics дозволяє реєструвати відвідування декількох ресурсів (наприклад основий сайт та його субсайти) як один сеанс. Детальніше можна дізнатись <a href="https://support.google.com/analytics/answer/1034342?hl=ru">тут</a>.'
            ];
        }

        return $fields;
    }
}
