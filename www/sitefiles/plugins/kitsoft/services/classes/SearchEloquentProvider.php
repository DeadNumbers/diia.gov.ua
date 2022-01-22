<?php namespace KitSoft\Services\Classes;

use KitSoft\Search\Providers\Eloquent\Provider;
use KitSoft\Services\Models\Service;

class SearchEloquentProvider extends Provider {
	/**
     * prepareItem
     */
    protected function prepareItem(Service $item) {
        $item->title = $item->name;
        unset($item->name);
    }
}