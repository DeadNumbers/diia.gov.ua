<?php namespace KitSoft\Search\Models;

use App;
use Crypt;
use Flash;
use Model;
use Config;
use Cms\Classes\Theme;
use KitSoft\Pages\Classes\PagesHelper;
use October\Rain\Exception\ValidationException;

class Settings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $rules = [
        'fields.elastic_max_items_limit' => 'int'
    ];

    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageSettingsModel',
        '@KitSoft.Revisions.Behaviors.RevisionsModel',
        'System.Behaviors.SettingsModel'
    ];

    // A unique code
    public $settingsCode = 'kitsoft_search_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    // Page list for drop down fields
    protected $pages = [];

    /**
     * beforeSave
     */
    public function beforeSave()
    {
        $this->value = array_merge($this->value, [
            'elastic_password' => Crypt::encrypt($this->value['elastic_password'])
        ]);
    }

    /**
     * getElasticPasswordAttribute
     */
    public function getElasticPasswordAttribute($value)
    {
        if (!$value) {
            return;
        }
        return Crypt::decrypt($value);
    }

    /**
     * getPagesOptions
     */
    public function getPagesOptions()
    {
        return PagesHelper::getRoutingPagesOptions();
    }


    public function getSearchTypeOptions()
    {
        return ['elastic', 'default'];
    }
}
