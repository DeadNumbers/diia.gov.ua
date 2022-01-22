<?php namespace KitSoft\Services\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateLifeSituationsTable extends Migration
{
    public function up()
    {
        // life situations
        Schema::create('kitsoft_services_life_situations', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->index();
            $table->text('content')->nullable();
            $table->text('excerpt')->nullable();
            $table->boolean('published')->default(false);
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->integer('nest_left')->nullable();
            $table->integer('nest_right')->nullable();
            $table->integer('nest_depth')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('og_image')->nullable();
            $table->timestamps();
        });

        // related services
        Schema::create('kitsoft_services_life_situations_services', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('life_situation_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->primary(['life_situation_id', 'service_id']);

            $table->foreign('life_situation_id')
                ->references('id')->on('kitsoft_services_life_situations')
                ->onDelete('cascade');

            $table->foreign('service_id')
                ->references('id')->on('kitsoft_services_services')
                ->onDelete('cascade');
        });

        // sections
        Schema::create('kitsoft_services_life_situations_entities', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('life_situation_id')->unsigned();
            $table->integer('entity_id')->unsigned();
            $table->string('entity_type');

            $table->primary(['life_situation_id', 'entity_id', 'entity_type']);

            $table->foreign('life_situation_id')
                ->references('id')->on('kitsoft_services_life_situations')
                ->onDelete('cascade');
        });

        // subcategories
        Schema::create('kitsoft_services_life_situations_subcategories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('subcategory_id')->unsigned();
            $table->integer('life_situation_id')->unsigned();
            $table->primary(['subcategory_id', 'life_situation_id']);

            $table->foreign('subcategory_id')
                ->references('id')->on('kitsoft_services_subcategories')
                ->onDelete('cascade');

            $table->foreign('life_situation_id')
                ->references('id')->on('kitsoft_services_life_situations')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_services_life_situations_subcategories');
        Schema::dropIfExists('kitsoft_services_life_situations_entities');
        Schema::dropIfExists('kitsoft_services_life_situations_services');
        Schema::dropIfExists('kitsoft_services_life_situations');
    }
}
