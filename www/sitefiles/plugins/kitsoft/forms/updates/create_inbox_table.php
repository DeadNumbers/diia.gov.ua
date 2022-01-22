<?php namespace KitSoft\Forms\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateInboxTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_forms_inbox', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('form_id');
            $table->text('fields');
            $table->string('ip');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_forms_inbox');
    }
}
