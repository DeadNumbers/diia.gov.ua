<?php namespace KitSoft\MultiLanguage\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_multilanguage_fields', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('locale')->index();
            $table->integer('entity_id')->index();
            $table->string('entity_type')->index();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_multilanguage_fields');
    }
}
