<?php namespace KitSoft\Search\Models;

use Model;
use Config;

class ProvidersSettings extends Model
{
    public $implement = [
        '@KitSoft.MultiSite.Behaviors.MultiSiteSettingsModel',
        '@KitSoft.Revisions.Behaviors.RevisionsModel',
        'System.Behaviors.SettingsModel'
    ];

    // A unique code
    public $settingsCode = 'kitsoft_search_providers_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    /**
     * getFieldConfig
     */
    public function getFieldConfig()
    {
        $fields = $this->makeConfig($this->settingsFields);

        $fields = $this->addProvidersFields($fields);

        return $fields;
    }

    /**
     * addProvidersFields
     */
    protected function addProvidersFields($fields)
    {
        $providers = Config::get('kitsoft.search::config.providers');

        $fields->tabs['fields']['disabled_providers'] = [
            'label' => 'Disable search providers',
            'tab' => 'Providers',
            'type' => 'checkboxlist',
            'options' => array_combine(array_keys($providers), array_keys($providers))
        ];

        return $fields;
    }
}
