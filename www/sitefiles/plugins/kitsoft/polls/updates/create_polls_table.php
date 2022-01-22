<?php namespace KitSoft\Polls\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePollsTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_polls_polls', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('question_id')->nullable();
            $table->string('title', 255);
            $table->text('description');
            $table->timestamps();

            $table->foreign('question_id')
                ->references('id')->on('kitsoft_polls_questions')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_polls_polls');
    }
}
