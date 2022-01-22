<?php namespace KitSoft\TagsManager\Updates;

use KitSoft\TagsManager\Models\Tag;
use October\Rain\Database\Updates\Migration;

class FixNames extends Migration
{
    public function up()
    {
        Tag::withoutGlobalScopes()->chunk(500, function ($items) {
        	$items->each(function ($item) {
        		$item->name = str_replace(',', '', $item->name);
                $item->name = str_replace('.', '', $item->name);
        		$item->forceSave();
        	});
        });
    }

    public function down()
    {
        
    }
}
