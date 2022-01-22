<?php namespace KitSoft\Services\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_services_services', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->index();
            $table->text('content')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['content', 'link'])->default('content');
            $table->boolean('is_top')->default('false');
            $table->boolean('published')->default(false);
            $table->text('fields')->nullable();
            $table->integer('hits')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::create('kitsoft_services_services_subcategories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('subcategory_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->integer('sort_order')->default(0);
            $table->primary(['subcategory_id', 'service_id']);

            $table->foreign('subcategory_id')
                ->references('id')->on('kitsoft_services_subcategories')
                ->onDelete('cascade');

            $table->foreign('service_id')
                ->references('id')->on('kitsoft_services_services')
                ->onDelete('cascade');
        });

        Schema::create('kitsoft_services_services_related', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('related_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->primary(['related_id', 'service_id']);

            $table->foreign('related_id')
                ->references('id')->on('kitsoft_services_services')
                ->onDelete('cascade');

            $table->foreign('service_id')
                ->references('id')->on('kitsoft_services_services')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_services_services_subcategories');
        Schema::dropIfExists('kitsoft_services_services_related');
        Schema::dropIfExists('kitsoft_services_services');
    }
}
