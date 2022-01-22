<?php namespace KitSoft\Forms\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_forms_fields', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('form_id');
            $table->string('title')->nullable();
            $table->string('code');
            $table->string('type')->nullable();
            $table->string('placeholder')->nullable();
            $table->string('rules')->nullable();
            $table->text('options')->nullable();
            $table->integer('sort_order')->unsigned()->nullable()->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_forms_fields');
    }
}
