<?php namespace KitSoft\Pages\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_pages_sections', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('published')->default(0);
            $table->string('name', 255);
            $table->text('fields')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_pages_sections');
    }
}
