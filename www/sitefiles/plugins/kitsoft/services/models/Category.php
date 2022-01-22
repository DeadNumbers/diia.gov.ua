<?php namespace KitSoft\Services\Models;

use Model;

/**
 * Category Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Sortable;

    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel',
        '@KitSoft.Pages.Behaviors.RelationFinderModel'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_services_categories';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    public $relationFinder = [
        'nameFrom' => 'name'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'subcategories' => [
            'KitSoft\Services\Models\SubCategory',
            'table' => 'kitsoft_services_subcategories_categories',
            'otherKey' => 'subcategory_id',
            'pivot' => ['sort_order', 'parent_id'],
            'order' => 'sort_order',
        ],
        'subcategories_list' => [
            'KitSoft\Services\Models\SubCategory',
            'table' => 'kitsoft_services_subcategories_categories',
            'otherKey' => 'subcategory_id'
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
     * scopeIsTop
     */
    public function scopeIsTop($query)
    {
        return $query->where('is_top', true);
    }

    /**
     * getSubcategoryTree
     */
    public function getSubcategoryTree(string $slug)
    {
        return $this->getSubcategoriesTreeAttribute($slug)
            ->first();
    }

    /**
     * getSubcategoriesTreeAttribute
     */
    public function getSubcategoriesTreeAttribute($slug = null)
    {
        return $this->subcategories
            ->filter(function ($item) use ($slug) {
                if ($slug) {
                    return ($item->slug == $slug);
                }
                return !isset($item->pivot->parent_id);
            })->transform(function ($item) {
                return $this->getSubcategoryWithChilds($item->id);
            });
    }

    /**
     * getSubcategoryWithChilds
     */
    protected function getSubcategoryWithChilds(int $id)
    {
        $item = $this->subcategories->find($id);

        $item->children = $this->subcategories
            ->where('pivot.parent_id', $id)
            ->transform(function ($item) {
                return $this->getSubcategoryWithChilds($item->id);
            });

        return $item;
    }
}
