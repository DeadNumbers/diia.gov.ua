<?php

namespace KitSoft\Pages\MenuItemTypes;

use KitSoft\Pages\Models\MenuItem;

class AbstractType
{
    /**
     * list
     */
    public static function list()
    {
        return [];
    }

    /**
     * url
     */
    public static function url(MenuItem $item)
    {
        return;
    }
}
