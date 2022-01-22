<?php namespace KitSoft\Core\Models;

use Model;

/**
 * Sentry Model
 */
class Sentry extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = [
        '@KitSoft.Revisions.Behaviors.RevisionsModel',
        'System.Behaviors.SettingsModel'
    ];

    // A unique code
    public $settingsCode = 'kitsoft_core_sentry_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public $rules = [
        'enable' => 'boolean',
        'dsn' => 'url|required_if:enable,true,on,1',
        'error_level' => 'required_if:enable,true,on,1'
    ];

    /**
     * getIsEnabledAttribute
     */
    public function getIsEnabledAttribute()
    {
        return $this->get('enable');
    }

    /**
     * getErrorLevelOptions
     */
    public function getErrorLevelOptions()
    {
        return [
            100 => 'Debug - Level 100 - Detailed debug information',
            200 => 'Info - Level 200 - Interesting events e.g. user logs in, SQL logs',
            250 => 'Notice - Level 250 - Uncommon events',
            300 => 'Warning - Level 300 - Exceptional occurrences that are not errors',
            400 => 'Error - Level 400 - Runtime errors',
            500 => 'Critical - Level 500 - Critical conditions',
            550 => 'Alert - Level 550 - Action must be taken immediately',
            600 => 'Emergency - Level 600 - Urgent alert'
        ];
    }
}
