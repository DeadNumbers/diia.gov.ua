<?php namespace KitSoft\Pages\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateMenuItemsTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_pages_menu_items', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('menu_id')->unsigned()->index();
            $table->string('title')->nullable();
            $table->boolean('isHidden')->default(false)->index();
            $table->boolean('isExternal')->default(false);

            $table->string('type')->nullable();
            $table->string('value')->nullable();

            // Nesting
            $table->integer('parent_id')->nullable()->unsigned()->index();
            $table->integer('nest_left')->nullable();
            $table->integer('nest_right')->nullable();
            $table->integer('nest_depth')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_pages_menu_items');
    }
}
