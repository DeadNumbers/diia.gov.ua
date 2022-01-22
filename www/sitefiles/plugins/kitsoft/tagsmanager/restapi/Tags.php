<?php namespace KitSoft\TagsManager\RestApi;

use Backend\Classes\Controller;
use KitSoft\TagsManager\Models\Tag;

/**
 * Tags Back-end Controller
 * see /plugins/kitsoft/restapi/readme.md
 */
class Tags extends Controller
{
    public $implement = [
        '@KitSoft.RestApi.Behaviors.RecordsController'
    ];
}