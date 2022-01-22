<?php namespace KitSoft\MultiLanguage\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateRelatiosTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_multilanguage_entities', function($table)
        {
            $table->engine = 'InnoDB';
            $table->string('locale')->index();
            $table->integer('entity_id')->index();
            $table->integer('relation_id')->index();
            $table->string('entity_type')->index();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_multilanguage_entities');
    }
}
