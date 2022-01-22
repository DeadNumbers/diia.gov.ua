<?php namespace KitSoft\Core\Models;

use Cache;
use KitSoft\Core\Classes\RobotsTxtHelpers;
use Model;

/**
 * RobotsTxt Model
 */
class RobotsTxt extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = [
        '@KitSoft.MultiSite.Behaviors.MultiSiteSettingsModel',
        '@KitSoft.Revisions.Behaviors.RevisionsModel',
        'System.Behaviors.SettingsModel'
    ];

    // A unique code
    public $settingsCode = 'kitsoft_core_robots_txt';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public $rules = [];

    public function afterSave()
    {
        Cache::forget(RobotsTxtHelpers::getCacheKey());
    }
}
