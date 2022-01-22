<?php namespace KitSoft\TagsManager\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AlterTableAddSlugDescriptionFields extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_tagsmanager_tags', function (Blueprint $table) {
            if (!Schema::hasColumn('kitsoft_tagsmanager_tags', 'slug')) {
                $table->string('slug')->nullable();
            }
            if (!Schema::hasColumn('kitsoft_tagsmanager_tags', 'description')) {
                $table->text('description')->nullable();
            }
        });
    }

    public function down()
    {
    }
}
