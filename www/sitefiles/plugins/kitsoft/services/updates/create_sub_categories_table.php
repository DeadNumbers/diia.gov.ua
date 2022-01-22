<?php namespace KitSoft\Services\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateSubCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_services_subcategories', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->index();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('kitsoft_services_subcategories_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('subcategory_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('sort_order')->default(0);
            $table->primary(['subcategory_id', 'category_id']);

            $table->foreign('subcategory_id')
                ->references('id')->on('kitsoft_services_subcategories')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')->on('kitsoft_services_categories')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_services_subcategories_categories');
        Schema::dropIfExists('kitsoft_services_subcategories');
    }
}
