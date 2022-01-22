<?php namespace KitSoft\Pages\Components;

use Cache;
use Cms\Classes\ComponentBase;
use KitSoft\Pages\Models\Menu as MenuModel;

class Menu extends ComponentBase
{
    public $menu;
    public $menuItems;
    protected $code;

    public function componentDetails()
    {
        return [
            'name'        => 'kitsoft.pages::lang.components.menu.name',
            'description' => 'kitsoft.pages::lang.components.menu.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'code' => [
                'title' => 'kitsoft.pages::lang.menuitems.fields.code',
                'type' => 'dropdown',
                'options' => MenuModel::lists('code', 'code')
            ],
            'class' => [
                'title' => 'kitsoft.pages::lang.menuitems.fields.class'
            ],
            'classItem' => [
                'title' => 'kitsoft.pages::lang.menuitems.fields.classItem'
            ]
        ];
    }

    /**
     * onRun
     */
    public function onRun()
    {
        $this->code = $this->property('code');

        if (!$this->menu = $this->loadMenu()) {
            return;
        }

        $this->menuItems = Cache::remember("kitsoft.pages.menu.{$this->menu->id}", 1440, function () {
            return $this->loadMenuItems();
        });
    }

    /**
     * loadMenu
     */
    protected function loadMenu()
    {
        return MenuModel::where('code', $this->code)->first();
    }

    /**
     * loadMenuItems
     */
    protected function loadMenuItems()
    {
        return $this->menu->preparedItemsTree;
    }
}
