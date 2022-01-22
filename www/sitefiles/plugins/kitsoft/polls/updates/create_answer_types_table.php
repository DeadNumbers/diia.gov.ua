<?php namespace KitSoft\Polls\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateAnswerTypesTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_polls_answer_types', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_polls_answer_types');
    }
}
