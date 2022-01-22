<?php namespace KitSoft\TaxSystems\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AlterTaxSystemsTableAddFields extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_taxsystems_tax_systems', function(Blueprint $table) {
			$table->text('fields')->nullable();
        });
    }

    public function down()
    {
        Schema::table('kitsoft_taxsystems_tax_systems', function(Blueprint $table) {
            $table->dropColumn('fields');
        });
    }
}