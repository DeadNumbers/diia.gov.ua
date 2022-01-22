<?php namespace KitSoft\Forms\Models;

use Model;

/**
 * Settings Model
 */
class Settings extends Model
{
    public $implement = [
    	'@KitSoft.MultiLanguage.Behaviors.MultiLanguageSettingsModel',
    	'@KitSoft.MultiSite.Behaviors.MultiSiteSettingsModel',
    	'@KitSoft.Revisions.Behaviors.RevisionsModel',
        'System.Behaviors.SettingsModel'
    ];

    public $settingsCode = 'kitsoft_forms_settings';

    public $settingsFields = 'fields.yaml';
}
