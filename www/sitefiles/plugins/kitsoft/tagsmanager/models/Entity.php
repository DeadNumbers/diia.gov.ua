<?php namespace KitSoft\TagsManager\Models;

use October\Rain\Database\Model;

class Entity extends Model
{
    public $table = 'kitsoft_tagsmanager_entities';

    public $timestamps = false;

    protected $primary_key = null;

    public $incrementing = false;
}
