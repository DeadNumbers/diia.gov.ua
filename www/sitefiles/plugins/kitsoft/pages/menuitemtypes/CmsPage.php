<?php

namespace KitSoft\Pages\MenuItemTypes;

use Cms\Classes\Page;
use KitSoft\Pages\MenuItemTypes\AbstractType;
use KitSoft\Pages\Models\MenuItem;

class CmsPage extends AbstractType
{
    /**
     * list
     */
    public static function list()
    {
        $pages = Page::sortBy('baseFileName')
            ->filter(function ($item) {
                return !strstr($item->url, ':');
            });

        foreach ($pages as $item) {
            $data[$item->baseFileName] = "{$item->title} ({$item->url})";
        }

        return $data;
    }

    /**
     * url
     */
    public static function url(MenuItem $item)
    {
        if (!$page = Page::find($item->value)) {
            return;
        }
        return $page->url;
    }
}
