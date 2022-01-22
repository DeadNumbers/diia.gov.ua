<?php namespace KitSoft\Services\Models;

use Model;

/**
 * Settings Model
 */
class Settings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = [
        '@KitSoft.MultiSite.Behaviors.MultiSiteSettingsModel',
        '@KitSoft.Revisions.Behaviors.RevisionsModel',
        'System.Behaviors.SettingsModel',
    ];

    // A unique code
    public $settingsCode = 'kitsoft_services_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public $rules = [
        'serviceFormSendTo' => 'required|email'
    ];
}
