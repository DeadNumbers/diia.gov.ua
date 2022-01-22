<?php namespace KitSoft\Search\Providers\Eloquent;

use KitSoft\Persons\Models\Person;
use KitSoft\Search\Providers\Eloquent\Provider;
use Cms\Classes\Page;

class PersonsProvider extends Provider
{
    protected $filters = ['key', 'type', 'groups'];

    /**
     * prepareItem
     */
    protected function prepareItem(Person $item)
    {
        $item->title = $item->fullName();
    }

    /**
     * applyGroupsFilter
     */
    protected function applyGroupsFilter()
    {
        if ($groups = request()->groups) {
            return $this->query->filterGroups(explode(',', $groups));
        }
    }
}
