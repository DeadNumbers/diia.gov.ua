<?php namespace KitSoft\Search\Providers\Elastic;

use KitSoft\Search\Providers\Elastic\Provider;

class PersonsProvider extends Provider
{
    protected $filters = ['key', 'to', 'from', 'tags'];

    /**
     * prepareItem
     */
    protected function prepareItem(&$item, $source)
    {
        $item['title'] = "{$item['last_name']} {$item['first_name']} {$item['middle_name']}";
    }
}
