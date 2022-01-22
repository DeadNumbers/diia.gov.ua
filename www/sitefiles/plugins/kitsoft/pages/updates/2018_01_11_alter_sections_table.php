<?php namespace KitSoft\Pages\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AlterSectionsTable extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_pages_sections', function(Blueprint $table) {
            $table->string('title')->nullable();
        });
    }

    public function down()
    {
        
    }
}
