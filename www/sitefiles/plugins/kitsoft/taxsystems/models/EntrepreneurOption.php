<?php namespace KitSoft\TaxSystems\Models;

use KitSoft\TaxSystems\Models\EntrepreneurQuestion;
use KitSoft\TaxSystems\Models\TaxSystem;
use Model;

/**
 * EntrepreneurOption Model
 */
class EntrepreneurOption extends Model
{
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_taxsystems_entrepreneur_options';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'text' => 'required',
        'type' => 'required',
        'published' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'entrepreneur_question' => EntrepreneurQuestion::class
    ];
    public $belongsToMany = [
        'tax_systems' => [
            TaxSystem::class,
            'table' => 'kitsoft_taxsystems_entrepreneur_options_tax_systems',
            'otherKey' => 'tax_system_id',
            'order' => 'sort_order',
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * beforeCreate
     */
    public function beforeCreate()
    {
        $this->sort_order = self::withoutGlobalScopes()->max('sort_order') + 1;
    }

    /**
     * scopeIsPublished
     */
    public function scopeIsPublished($query)
    {
        return $query
            ->whereNotNull('published')
            ->where('published', true);
    }

    /**
     * getTaxSystemsOptions
     */
    public function getTaxSystemsOptions()
    {
        return TaxSystem::lists('title', 'id');
    }
}
