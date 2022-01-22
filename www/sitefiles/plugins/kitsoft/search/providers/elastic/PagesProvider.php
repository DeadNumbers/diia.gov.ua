<?php namespace KitSoft\Search\Providers\Elastic;

use KitSoft\Search\Providers\Elastic\Provider;

class PagesProvider extends Provider
{
    protected $filters = ['key', 'from', 'to', 'tags'];

    /**
     * extendDefaultFilter
     */
    protected function extendDefaultFilter(array $filters): array
    {
    	return array_merge($filters, [
    		'selected_searchable' => true
    	]);
    }
}
