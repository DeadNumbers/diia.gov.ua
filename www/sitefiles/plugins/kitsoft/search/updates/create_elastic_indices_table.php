<?php namespace KitSoft\Search\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateElasticIndicesTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_search_elastic_indices', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('type');
            $table->string('index_name');
            $table->json('mapping');
            $table->boolean('in_process')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_search_elastic_indices');
    }
}
