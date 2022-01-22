<?php namespace KitSoft\Core\Models;

use KitSoft\Core\Classes\PluginHelpers;
use Model;

/**
 * DomainChanging Model
 */
class DomainChanging extends Model
{
    // A unique code
    public $settingsCode = 'kitsoft_core_domain_changing';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public $implement = [
        'System.Behaviors.SettingsModel'
    ];

    /**
     * getModelOptions
     */
    public function getModelOptions()
    {
        $result = collect();

        PluginHelpers::getModelsExtendedWith('KitSoft.Pages.Behaviors.RelationFinderModel')
            ->each(function($item) use (&$result) {
                $result = $result->merge($item);
            });

        return $result->mapWithKeys(function($item) {
            return [$item => $item];
        });
    }
}