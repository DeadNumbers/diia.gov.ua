<?php namespace KitSoft\TaxSystems\Models;

use KitSoft\TaxSystems\Models\EntrepreneurOption;
use Model;
use ValidationException;

/**
 * TaxSystem Model
 */
class TaxSystem extends Model
{
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\Validation;

    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel',
        '@KitSoft.Pages.Behaviors.RelationFinderModel'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_taxsystems_tax_systems';

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
        'title' => 'required|max:191',
        'slug' => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:kitsoft_taxsystems_tax_systems', 'max:191'],
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
    protected $jsonable = ['fields'];

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
    public $belongsTo = [];
    public $belongsToMany = [
        'entrepreneur_options' => [
            EntrepreneurOption::class,
            'table' => 'kitsoft_taxsystems_entrepreneur_options_tax_systems',
            'otherKey' => 'entrepreneur_option_id',
            'order' => 'sort_order',
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

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
     * beforeCreate
     */
    public function beforeCreate()
    {
        $this->sort_order = self::withoutGlobalScopes()->max('sort_order') + 1;
    }

    /**
     * findByOptionsList
     */
    public static function findByOptionsList(array $optionIds)
    {
        $options = EntrepreneurOption::whereIn('id', $optionIds)->get();

        if (!$options->count()) {
            return;
        }

        if ($options->count() == 1) {
            $intersect = $options->pluck('tax_systems.*.slug')
                ->flatten()
                ->toArray();
        } else {
            $intersect = call_user_func_array('array_intersect',
                $options->pluck('tax_systems.*.slug')->toArray()
            );
        }

        if (!count($intersect)) {
            return;
        }

        return self::isPublished()
            ->whereIn('slug', $intersect)
            ->first();
    }
}
