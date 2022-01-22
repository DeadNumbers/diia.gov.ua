<?php namespace KitSoft\Services\Models;

use Model;

/**
 * LifeSituation Model
 */
class LifeSituation extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\NestedTree;

    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel',
        '@KitSoft.Pages.Behaviors.RelationFinderModel'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_services_life_situations';

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
        'title' => ['required', 'max:191'],
        'slug' => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:kitsoft_services_life_situations', 'max:191'],
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
    public $belongsTo = [];
    public $belongsToMany = [
        'services' => [
            'KitSoft\Services\Models\Service',
            'table' => 'kitsoft_services_life_situations_services',
        ],
        'subcategories' => [
            'KitSoft\Services\Models\SubCategory',
            'table' => 'kitsoft_services_life_situations_subcategories',
            'key' => 'life_situation_id',
            'otherKey' => 'subcategory_id'
        ],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'image' => ['KitSoft\Pages\Models\SystemFile']
    ];
    public $attachMany = [];
    public $morphedByMany = [
        'sections' => [
            'KitSoft\Pages\Models\Section',
            'name' => 'entity',
            'key' => 'life_situation_id',
            'table' => 'kitsoft_services_life_situations_entities',
            'order' => 'sort_order asc'
        ]
    ];

    /**
     * beforeValidate
     */
    public function beforeValidate()
    {
        // fix nested for parent_id dropdown field
        $this->parent_id = empty($this->parent_id) ? null : $this->parent_id;
    }

    /*
     * scopeIsPublished
     */
    public function scopeIsPublished($query) {
        return $query->where('published', true);
    }

    /**
     * getSectionsAttribute
     */
    public function getSectionsAttribute()
    {
        if (!$this->parent_id) {
            return;
        }

        return $this->raw_sections
            ->keyBy('name');
    }

    /**
     * getRawSectionsAttribute
     */
    public function getRawSectionsAttribute()
    {
        if (!$this->parent_id) {
            return;
        }

        return $this->sections()
            ->where('published', true)
            ->get();
    }

    /**
     * getSectionsContentAttribute
     */
    public function getSectionsContentAttribute()
    {
        if (!$this->parent_id) {
            return $this->content;
        }

        return $this->content . ' ' . $this->rawSections
            ->transform(function ($item) {
                return collect($item->fields)->flatten();
            })
            ->collapse()
            ->implode('. ');
    }

    /**
     * getChildsAttribute
     */
    public function getChildsAttribute()
    {
        return $this->children()
            ->isPublished()
            ->get();
    }

    /**
     * getParentIdOptions
     */
    public function getParentIdOptions()
    {
        return self::where('id', '<>', $this->id)
            ->get()
            ->listsNested('title', 'id');
    }
}
