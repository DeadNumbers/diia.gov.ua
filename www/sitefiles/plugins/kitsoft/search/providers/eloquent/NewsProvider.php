<?php namespace KitSoft\Search\Providers\Eloquent;

use KitSoft\Search\Providers\Eloquent\Provider;

class NewsProvider extends Provider
{
    protected $filters = ['key', 'type', 'from', 'to', 'categories'];

    /**
     * applyCategoriesFilter
     */
    protected function applyCategoriesFilter()
    {
        if ($data = request()->categories) {
            $this->query->whereHas('categories', function ($query) use ($data) {
            	return $query->whereIn('slug', explode(',', $data));
            });
        }
    }
}
