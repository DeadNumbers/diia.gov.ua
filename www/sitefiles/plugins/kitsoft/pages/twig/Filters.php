<?php

namespace KitSoft\Pages\Twig;

use KitSoft\Pages\FormWidgets\RelationFinder;
use KitSoft\Pages\Models\Page;
use October\Rain\Argon\Argon;

class Filters
{
    /**
     * pageLink
     */
    public static function pageLink($page_id, $slugs = null)
    {
        if (!$page = Page::withoutGlobalScopes()->find((int)$page_id)) {
            return;
        }

        $url = $page->url;

        if (!$slugs) {
            return $url;
        }

        if ($page->sluggable) {
            foreach ($slugs as $key => $row) {
                $url = str_replace(":{$key}", $row, $url);
            }
        }

        return $url;
    }

    /**
     * relationFinder
     */
    public static function relationFinder($fields)
    {
        return RelationFinder::getModelObject($fields);
    }

    /**
     * argon
     */
    public static function argon($value, $mask = null)
    {
        if (!isset($value)) {
            return;
        }

        if ($mask) {
            return Argon::createFromFormat($mask, $value);
        }

        return Argon::parse($value);
    }
}
