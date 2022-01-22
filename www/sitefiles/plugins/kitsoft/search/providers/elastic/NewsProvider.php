<?php namespace KitSoft\Search\Providers\Elastic;

use KitSoft\Search\Providers\Elastic\Provider;

class NewsProvider extends Provider
{
    protected $filters = ['key', 'from', 'to', 'tags', 'categories'];

    /**
     * applyCategoriesFilter
     */
    protected function applyCategoriesFilter()
    {
        $this->requestTemplate['body']['params']['selected_category_slugs'] = request()->get('categories');
    }
}
