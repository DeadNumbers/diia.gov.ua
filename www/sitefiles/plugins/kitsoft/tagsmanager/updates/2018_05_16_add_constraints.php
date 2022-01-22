<?php namespace KitSoft\TagsManager\Updates;

use KitSoft\TagsManager\Models\Entity;
use KitSoft\TagsManager\Models\Tag;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AddConstraints extends Migration
{
    public function up()
    {
        Entity::orderBy('tag_id')->chunk(500, function ($items) {
            $items->each(function ($item) {
                if(Tag::withoutGlobalScopes()->where('id', $item->tag_id)->first()) {
                    return;
                }
                Entity::where('tag_id', $item->tag_id)
                    ->delete();
            });
        });

        Schema::table('kitsoft_tagsmanager_entities', function (Blueprint $table) {
            $table->foreign('tag_id')
                ->references('id')->on('kitsoft_tagsmanager_tags')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
    }
}
