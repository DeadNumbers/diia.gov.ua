<?php namespace KitSoft\Search\Providers\Elastic;

use KitSoft\Search\Providers\Elastic\Provider;

class NpaProvider extends Provider
{
    protected $filters = ['key', 'from', 'to', 'tags', 'category', 'num'];

    /**
     * applyCategoryFilter
     */
    protected function applyCategoryFilter()
    {
        $this->requestTemplate['body']['params']['selected_category_id'] = request()->get('category');
    }

    /**
     * applyNumFilter
     */
    protected function applyNumFilter()
    {
        $this->requestTemplate['body']['params']['selected_number'] = request()->get('num');
    }
}
