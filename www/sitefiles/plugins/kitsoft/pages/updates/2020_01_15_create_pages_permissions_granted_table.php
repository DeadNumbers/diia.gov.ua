<?php namespace KitSoft\Pages\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePagesPermissionsGrantedTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_pages_pages_granted', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('user_id')->unsigned();
            $table->integer('page_id')->unsigned();
            $table->primary(['user_id', 'page_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_pages_pages_granted');
    }
}
