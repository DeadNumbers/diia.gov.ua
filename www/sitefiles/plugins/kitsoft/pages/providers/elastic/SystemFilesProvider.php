<?php namespace KitSoft\Pages\Providers\Elastic;

use KitSoft\Search\Providers\Elastic\Provider;

class SystemFilesProvider extends Provider
{
    protected $filters = ['key', 'to', 'from'];

    /**
     * prepareItem
     */
    protected function prepareItem(&$item, $source)
    {
        $item['title'] = isset($item['title']) && !empty($item['title'])
            ? $item['title']
            : $item['file_name'];
    }
}