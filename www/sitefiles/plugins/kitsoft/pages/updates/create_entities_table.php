<?php namespace KitSoft\Pages\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateEntitiesTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_pages_entities', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('page_id')->index('page_id_idx');
            $table->unsignedInteger('entity_id')->index('entity_id_idx');
            $table->string('entity_type')->index('entity_type_idx');
            $table->primary(['page_id', 'entity_id', 'entity_type'], 'page_entity_pk');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_pages_entities');
    }
}
