<?php namespace KitSoft\TagsManager\Updates;

use KitSoft\TagsManager\Models\Tag;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AddIndex extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_tagsmanager_entities', function (Blueprint $table) {
            $table->index(['entity_id', 'entity_type']);
        });
    }

    public function down()
    {
    }
}
