<?php namespace KitSoft\Core\Models;

use Event;
use Model;
use System\Classes\PluginManager;

/**
 * Settings Model
 */
class Settings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = [
        '@KitSoft.Revisions.Behaviors.RevisionsModel',
        'System.Behaviors.SettingsModel'
    ];

    // A unique code
    public $settingsCode = 'kitsoft_core_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public $rules = [];

    /**
     * beforeSave
     */
    public function beforeSave()
    {
        Event::fire('kitsoft.core::settings.beforeSave', [&$this]);
    }

    /**
     * getFieldConfig
     */
    public function getFieldConfig()
    {
        $fieldsConfig = $this->makeConfig($this->settingsFields);

        Event::fire('kitsoft.core::settings.extendFields', [&$fieldsConfig]);

        return $fieldsConfig;
    }
}
