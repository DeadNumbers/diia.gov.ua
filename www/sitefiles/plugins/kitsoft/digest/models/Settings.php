<?php namespace KitSoft\Digest\Models;

use Config;
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
        'System.Behaviors.SettingsModel'
    ];

    // A unique code
    public $settingsCode = 'kitsoft_digest_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public $rules = [
        'phplist.apiUrl' => 'url',
        'limit' => 'required_with:driver|integer|max:30'
    ];

    /**
     * getDriverOptions
     */
    public function getDriverOptions()
    {
        return collect(Config::get('kitsoft.digest::config.drivers'))
            ->mapWithKeys(function ($item, $key) {
                return [$item['class'] => $key];
            });
    }

    /**
     * getTypesOptions
     */
    public function getTypesOptions()
    {
        return collect(Config::get('kitsoft.digest::config.types'))
            ->mapWithKeys(function ($item, $key) {
                return [$key => $item['title']];
            });
    }

    /**
     * getActiveTypesOptions
     */
    public function getActiveTypesOptions()
    {
        return $this->getTypesOptions()->filter(function ($item, $key) {
            return in_array($key, (array)$this->types);
        });
    }

    /**
     * getDriverConfigAttribute
     */
    public function getDriverConfigAttribute()
    {
        return Config::get('kitsoft.digest::config.drivers.' . $this->driver);
    }

    /**
     * getTypesConfigAttribute
     */
    public function getTypesConfigAttribute()
    {
        if (!$this->types) {
            return;
        }

        return $this->getTypesOptions()->filter(function ($item, $key) {
            return in_array($key, $this->types);
        });
    }

    /**
     * beforeSave
     */
    public function beforeUpdate()
    {
        // hack for save field with type password
        $data = json_decode($this->original['value'], true);

        if (empty($this->value['phplist']['password'])) {
            $this->value = array_merge($this->value, [
                'phplist' => array_merge($this->value['phplist'], [
                    'password' => $data['phplist']['password']
                ])
            ]);
        }
    }
}
