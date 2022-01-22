<?php namespace KitSoft\Search\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DeleteElasticIndicesTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('kitsoft_search_elastic_indices');
    }

    public function down()
    {

    }
}
