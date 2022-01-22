<?php namespace KitSoft\RLBlogXT\Models;

use Model;

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
    public $settingsCode = 'kitsoft_rlblogxt_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public $rules = [
        'api_allowed_ips' => 'array',
        'api_allowed_ips.*.ip' => 'ip'
    ];
}
