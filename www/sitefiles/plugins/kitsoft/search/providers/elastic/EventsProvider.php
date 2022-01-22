<?php namespace KitSoft\Search\Providers\Elastic;

use KitSoft\Search\Providers\Elastic\Provider;

class EventsProvider extends Provider
{
    protected $filters = ['key', 'to', 'from', 'tags'];
}
