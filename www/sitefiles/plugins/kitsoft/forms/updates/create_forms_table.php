<?php namespace KitSoft\Forms\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateFormsTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_forms_forms', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('code')->index();
            $table->integer('template_id');
            $table->text('description')->nullable();
            $table->text('success_text')->nullable();
            $table->boolean('send')->default(0);
            $table->text('emails')->nullable();
            $table->string('submit_text')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_forms_forms');
    }
}