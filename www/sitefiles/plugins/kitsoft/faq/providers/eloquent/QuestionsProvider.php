<?php namespace KitSoft\Faq\Providers\Eloquent;

use KitSoft\Faq\Models\Question;
use KitSoft\Search\Providers\Eloquent\Provider;

class QuestionsProvider extends Provider
{
    /**
     * prepareItem
     */
    protected function prepareItem(Question $item)
    {
        $item->title = $item->question;
        $item->url = $item->url;
        unset($item->question);
    }
}
