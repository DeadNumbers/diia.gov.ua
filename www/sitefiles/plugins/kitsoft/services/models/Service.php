<?php namespace KitSoft\Services\Models;

use Backend\Facades\BackendAuth;
use KitSoft\Services\Classes\Helpers;
use Model;
use October\Rain\Argon\Argon;
use October\Rain\Database\Traits\Validation;

/**
 * Service Model
 */
class Service extends Model
{
    use Validation;

    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel',
        '@KitSoft.Pages.Behaviors.RelationFinderModel'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_services_services';

    public $rules = [
        'title' => 'required',
        'slug' => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:kitsoft_services_services'],
        'fields.link' => 'required_if:type,link',
        'type' => 'required'
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    public $jsonable = ['fields'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'subcategories' => [
            'KitSoft\Services\Models\SubCategory',
            'table' => 'kitsoft_services_services_subcategories',
            'key' => 'service_id',
            'otherKey' => 'subcategory_id',
            'pivot' => ['sort_order']
        ],
        'related_services' => [
            'KitSoft\Services\Models\Service',
            'table' => 'kitsoft_services_services_related',
            'key' => 'service_id',
            'otherKey' => 'related_id'
        ],
        'life_situations' => [
            'KitSoft\Services\Models\LifeSituation', 
            'table' => 'kitsoft_services_life_situations_services',
            'key' => 'service_id',
        ]
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
            'key' => 'service_id',
            'table' => 'kitsoft_services_services_entities',
            'order' => 'sort_order asc'
        ]
    ];

    /*
     * scopeIsPublished
     */
    public function scopeIsPublished($query) {
        return $query->where('published', true);
    }

    /*
     * scopeIsTop
     */
    public function scopeIsTop($query) {
        return $query->where('is_top', true);
    }

    /**
     * scopeFilterCategories
     */
    public function scopeFilterCategories($query, $categories)
    {
        return $query->whereHas('subcategories', function ($query) use ($categories) {
            return $query->whereHas('categories', function ($query) use ($categories) {
                return $query->whereIn('id', $categories);
            });
        });
    }

    /**
     * scopeFilterSubCategories
     */
    public function scopeFilterSubCategories($query, $categories)
    {
        return $query->whereHas('subcategories', function ($query) use ($categories) {
            return $query->whereIn('id', $categories);
        });
    }

    /*
     * filterFields
     */
    public function filterFields($fields, $context = null)
    {
        if (!isset($fields->published)) {
            return;
        }

        $user = BackendAuth::getUser();

        if (!$user->hasAnyAccess(['kitsoft.services.access_publish'])) {
            $fields->published->hidden = true;
        }
    }

    /**
     * getContentAttribute
     */
    public function getContentAttribute()
    {
        if (!$section = $this->rawSections->where('name', 'serviceContent')->first()) {
            return;
        }

        return $section->fields['content'] ?? null;
    }

    /**
     * getSectionsAttribute
     */
    public function getSectionsAttribute()
    {
        return $this->raw_sections->keyBy('name');
    }

    /**
     * getRawSectionsAttribute
     */
    public function getRawSectionsAttribute()
    {
        return $this->sections()
            ->where('published', true)
            ->get();
    }

    /**
     * getSectionsContentAttribute
     */
    public function getSectionsContentAttribute()
    {
        return $this->sections
            ->transform(function ($item) {
                return collect($item->fields)->flatten();
            })
            ->collapse()
            ->implode('. ');
    }

    /**
     * getIsPrintableAttribute
     */
    public function getIsPrintableAttribute()
    {
        return $this->raw_sections->filter(function ($item) {
            return (bool)array_get($item->fields, 'isPdfRender', false);
        })->count();
    }
}
