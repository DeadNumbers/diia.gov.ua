<?php namespace KitSoft\TaxSystems\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AlterQuestionsTableAddDescription extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_taxsystems_entrepreneur_questions', function(Blueprint $table) {
			$table->text('description')->nullable();
        });
    }

    public function down()
    {
        Schema::table('kitsoft_taxsystems_entrepreneur_questions', function(Blueprint $table) {
			$table->dropColumn('description');
        });
    }
}