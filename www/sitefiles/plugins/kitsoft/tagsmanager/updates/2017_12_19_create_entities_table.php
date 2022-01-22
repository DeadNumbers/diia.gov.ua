<?php namespace KitSoft\TagsManager\Updates;

use KitSoft\TagsManager\Models\Tag;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class CreateTagsEntities extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_tagsmanager_entities', function (Blueprint $table) {
            $table->integer('tag_id')->unsigned()->nullable()->default(null);
            $table->integer('entity_id')->unsigned()->nullable()->default(null);
            $table->string('entity_type')->nullable();

            $table->index(['tag_id', 'entity_id', 'entity_type']);
        });
    }

    public function down()
    {
    }
}
