<?php

namespace KitSoft\Pages\MenuItemTypes;

use KitSoft\Pages\MenuItemTypes\AbstractType;
use KitSoft\Pages\Models\MenuItem;

class Link extends AbstractType
{
    /**
     * url
     */
    public static function url(MenuItem $item)
    {
        return url($item->value);
    }
}
