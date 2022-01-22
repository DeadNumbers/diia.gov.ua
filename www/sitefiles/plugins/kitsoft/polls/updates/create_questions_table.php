<?php namespace KitSoft\Polls\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_polls_questions', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 1000);
            $table->text('text');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_polls_questions');
    }
}
