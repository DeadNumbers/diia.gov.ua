<?php namespace KitSoft\Pages\Models;

use Cache;
use KitSoft\Pages\Models\MenuItem;
use Model;
use October\Rain\Database\Collection;
use October\Rain\Database\Relations\HasMany;

/**
 * Menu Model
 */
class Menu extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_pages_menus';

    public $implement = [
        '@KitSoft.MultiLanguage.Behaviors.MultiLanguageModel',
        '@KitSoft.MultiSite.Behaviors.MultiSiteModel'
    ];

    public $rules = [
        'name' => 'required',
        'code' => 'required'
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'items' => ['KitSoft\Pages\Models\MenuItem'],
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * afterDelete
     */
    public function afterDelete() {
        Cache::forget("kitsoft.pages.menu.{$this->id}");
        
        MenuItem::where('menu_id', $this->id)
            ->delete();
    }

    /**
     * afterSave
     */
    public function afterSave() {
        Cache::forget("kitsoft.pages.menu.{$this->id}");
    }

    /**
     * getPreparedItemsTreeAttribute
     */
    public function getPreparedItemsTreeAttribute(Collection $items = null)
    {
        $items = $items ?? $this->items()->with('icon')->getNested();

        return $items
            ->transform(function ($item) {
                return [
                    'title' => $item->title,
                    'url' => $item->url,
                    'isExternal' => $item->isExternal,
                    'isHidden' => $item->isHidden,
                    'icon' => $item->icon,
                    'type' => $item->type,
                    'items' => $item->children->count()
                        ? $this->getPreparedItemsTreeAttribute($item->children)
                        : null
                ];
            })
            ->values()
            ->toArray();
    }
}
