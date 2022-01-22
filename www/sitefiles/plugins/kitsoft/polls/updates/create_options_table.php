<?php namespace KitSoft\Polls\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_polls_options', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('text');
            $table->string('action');
            $table->integer('answer_id')->nullable();
            $table->integer('question_id')->nullable();
            $table->integer('votes')->default(0);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('answer_id')
                ->references('id')->on('kitsoft_polls_answers')
                ->onDelete('set null');

            $table->foreign('question_id')
                ->references('id')->on('kitsoft_polls_questions')
                ->onDelete('set null');
        });

        Schema::create('kitsoft_polls_questions_options', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('question_id')->unsigned();
            $table->integer('option_id')->unsigned();
            $table->primary(['question_id', 'option_id']);

            $table->foreign('question_id')
                ->references('id')->on('kitsoft_polls_questions')
                ->onDelete('cascade');

            $table->foreign('option_id')
                ->references('id')->on('kitsoft_polls_options')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_polls_questions_options');
        Schema::dropIfExists('kitsoft_polls_options');
    }
}
