<?php namespace KitSoft\Services\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateServicesEntitiesTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_services_services_entities', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('service_id')->unsigned();
            $table->integer('entity_id')->unsigned();
            $table->string('entity_type');

            $table->primary(['service_id', 'entity_id', 'entity_type']);

            $table->foreign('service_id')
                ->references('id')->on('kitsoft_services_services')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_services_services_entities');
    }
}
