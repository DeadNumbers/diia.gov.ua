<?php namespace KitSoft\Search\Providers\Eloquent;

use Cms\Classes\Page;
use KitSoft\Search\Providers\Eloquent\Provider;
use KitSoft\Services\Models\Service;

class ServicesProvider extends Provider
{
    /**
     * prepareItem
     */
    protected function prepareItem(Service $item)
    {
        $item->title = $item->title ?? $item->name;
        unset($item->name);
    }
}
