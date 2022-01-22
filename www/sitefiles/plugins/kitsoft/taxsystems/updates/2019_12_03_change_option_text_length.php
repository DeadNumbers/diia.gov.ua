<?php namespace KitSoft\TaxSystems\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class ChangeOptionTextLength extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_taxsystems_entrepreneur_options', function(Blueprint $table) {
			$table->string('text', 500)->nullable()->change();
        });
    }

    public function down()
    {
        
    }
}