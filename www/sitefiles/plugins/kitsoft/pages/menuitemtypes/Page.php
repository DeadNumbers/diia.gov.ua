<?php

namespace KitSoft\Pages\MenuItemTypes;

use KitSoft\Pages\MenuItemTypes\AbstractType;
use KitSoft\Pages\Models\MenuItem;
use KitSoft\Pages\Models\Page as PageModel;

class Page extends AbstractType
{
    /**
     * list
     */
    public static function list()
    {
        return PageModel::orderBy('nest_left')
            ->get()
            ->listsNested('title', 'id');
    }

    /**
     * url
     */
    public static function url(MenuItem $item)
    {
        if (!$page = PageModel::find($item->value)) {
            return;
        }
        return $page->full_url;
    }
}
