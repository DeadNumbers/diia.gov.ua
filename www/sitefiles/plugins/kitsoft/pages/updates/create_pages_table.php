<?php namespace KitSoft\Pages\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePagesTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_pages_pages', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->string('title')->nullable();
            $table->string('slug')->index();
            $table->boolean('sluggable')->default(false)->index();
            $table->text('content')->nullable();
            $table->text('fields')->nullable();
            $table->string('layout')->nullable();
            $table->string('template')->nullable();
            $table->string('image')->nullable();
            $table->boolean('published')->default(false);
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->integer('nest_left')->nullable();
            $table->integer('nest_right')->nullable();
            $table->integer('nest_depth')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_pages_pages');
    }
}
