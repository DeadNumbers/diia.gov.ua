<?php namespace KitSoft\Search\Providers\Eloquent;

use KitSoft\Pages\Models\Page;
use KitSoft\Search\Providers\Eloquent\Provider;

class PagesProvider extends Provider
{
    /**
     * prepareItem
     */
    protected function prepareItem(Page $item)
    {
        $item->url = $item->fullUrl;
        unset($item->id, $item->parent_id);
    }
}
