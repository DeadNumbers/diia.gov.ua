<?php namespace KitSoft\Pages\Models;

use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\Pages\Classes\ValidationHelpers;
use Model;

/**
 * Partial Model
 */
class Partial extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_pages_partials';

    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel'
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    protected $jsonable = ['fields'];

    public $rules = [
        'title' => 'required|max:255',
        'code' => 'required|max:255'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * beforeValidate
     */
    public function beforeValidate()
    {
        // add validation rules only for update, not for create
        if ($this->id) {
            $rules = ValidationHelpers::getRulesFromFields($this->getConfigFields());
            $this->rules = array_merge($this->rules, $rules);
        }
    }

    /**
     * getConfigYaml
     */
    public function getConfigYaml()
    {
        return PagesHelper::getPartialConfig($this->code);
    }

    /**
     * getConfigFields
     */
    public function getConfigFields()
    {
        if (!$config = $this->getConfigYaml()) {
            return [];
        }

        return PagesHelper::getConfigFieldsFromTabs($config);
    }
}
