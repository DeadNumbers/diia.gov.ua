<?php namespace KitSoft\Pages\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AlterPagesTableAddSearchable extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_pages_pages', function(Blueprint $table) {
        	$table->boolean('searchable')->default(true)->index();
        });
    }

    public function down()
    {
        
    }
}