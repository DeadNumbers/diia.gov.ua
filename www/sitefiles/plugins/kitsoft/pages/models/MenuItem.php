<?php namespace KitSoft\Pages\Models;

use Config;
use Cache;
use KitSoft\Pages\MenuItemTypes\CmsPage;
use KitSoft\Pages\MenuItemTypes\Header;
use KitSoft\Pages\MenuItemTypes\Link;
use KitSoft\Pages\MenuItemTypes\Page;
use Model;

/**
 * MenuItem Model
 */
class MenuItem extends Model
{
    use \October\Rain\Database\Traits\NestedTree;
    use \October\Rain\Database\Traits\Validation;

    public $table = 'kitsoft_pages_menu_items';

    public $rules = [
        'title' => 'required',
        'type' => 'required'
    ];

    public $attachOne = [
        'icon' => ['System\Models\File', 'order' => 'sort_order'],
    ];

    protected $guarded = ['*'];

    protected $mapping = [
        'header' => Header::class,
        'link' => Link::class,
        'page' => Page::class,
        'cmsPage' => CmsPage::class,
    ];

    /**
     * beforeSave
     */
    public function beforeSave() {
        $this->value = ($this->type == 'link')
            ? $this->value_link
            : $this->value;

        unset($this->value_link);
    }

    /**
     * afterFetch
     */
    public function afterFetch() {
        $this->value_link = ($this->type == 'link') ? $this->value : null;
    }

    /**
     * getTypeOptions
     */
    public function getTypeOptions()
    {
        $options = array_combine(array_keys($this->mapping), [
            trans('kitsoft.pages::lang.menuitems.types.header'),
            trans('kitsoft.pages::lang.menuitems.types.link'),
            trans('kitsoft.pages::lang.menuitems.types.page'),
            trans('kitsoft.pages::lang.menuitems.types.cmsPage'),
        ]);

        if (!Config::get('kitsoft.pages::config.enableMenuCmsPage')) {
            unset($options['cmsPage']);
        }

        return $options;
    }

    /**
     * getValueOptions
     */
    public function getValueOptions()
    {
        return ($this->type)
            ? $this->mapping[$this->type]::list()
            : [];
    }

    /**
     * getUrlAttribute
     */
    public function getUrlAttribute() {
        if(!$this->type) {
            return;
        }
        return $this->mapping[$this->type]::url($this);
    }

    /**
     * afterDelete
     */
    public function afterDelete() {
        Cache::forget("kitsoft.pages.menu.{$this->menu_id}");
    }

    /**
     * afterSave
     */
    public function afterSave() {
        Cache::forget("kitsoft.pages.menu.{$this->menu_id}");
    }
}
