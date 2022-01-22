<?php namespace KitSoft\TaxSystems\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AlterQuestionsTable extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_taxsystems_entrepreneur_questions', function(Blueprint $table) {
			$table->integer('depends_on_question_id')->unsigned()->nullable();
			$table->integer('depends_on_option_id')->unsigned()->nullable();
        });
    }

    public function down()
    {
        Schema::table('kitsoft_taxsystems_entrepreneur_questions', function(Blueprint $table) {
			$table->dropColumn('depends_on_question_id');
			$table->dropColumn('depends_on_option_id');
        });
    }
}