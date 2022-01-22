<?php namespace KitSoft\Search\Providers\Eloquent;

use KitSoft\Search\Providers\Eloquent\Provider;

class EventsProvider extends Provider
{
    protected $filters = ['key', 'type', 'from', 'to'];
}
