<?php namespace KitSoft\Faq\Providers\Elastic;

use KitSoft\Search\Providers\Elastic\Provider;

class QuestionsProvider extends Provider
{
    protected $filters = ['key', 'tags'];

    /**
     * prepareItem
     */
    protected function prepareItem(&$item, $source)
    {
        $item['title'] = $item['question'];
        unset($item['question']);
    }
}
