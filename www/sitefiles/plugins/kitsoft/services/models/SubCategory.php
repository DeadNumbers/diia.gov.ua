<?php namespace KitSoft\Services\Models;

use KitSoft\Services\Models\Category;
use Model;

/**
 * SubCategory Model
 */
class SubCategory extends Model
{
    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_services_subcategories';

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
        'categories' => [
            'KitSoft\Services\Models\Category',
            'table' => 'kitsoft_services_subcategories_categories',
            'order' => 'kitsoft_services_categories.sort_order',
            'key' => 'subcategory_id'
        ],
        'services_list' => [
            'KitSoft\Services\Models\Service', 
            'table' => 'kitsoft_services_services_subcategories',
            'key' => 'subcategory_id',
        ],
        'services' => [
            'KitSoft\Services\Models\Service', 
            'table' => 'kitsoft_services_services_subcategories',
            'key' => 'subcategory_id',
            'pivot' => ['sort_order'],
            'order' => 'sort_order',
        ],
        'life_situations' => [
            'KitSoft\Services\Models\LifeSituation', 
            'table' => 'kitsoft_services_life_situations_subcategories',
            'key' => 'subcategory_id',
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * getUrl
     */
    public function getUrl(Category $category)
    {
        if (!$url = $category->url) {
            return;
        }

        return $url . '/' . $this->slug;
    }

    /**
     * getFullUrl
     */
    public function getFullUrl(Category $category)
    {
        if (!$url = $category->full_url) {
            return;
        }

        return $url . '/' . $this->slug;
    }

    /**
     * getQueryParamsAttribute
     */
    public function getQueryParamsAttribute()
    {
        return "?subcategories={$this->slug}";
    }
}
