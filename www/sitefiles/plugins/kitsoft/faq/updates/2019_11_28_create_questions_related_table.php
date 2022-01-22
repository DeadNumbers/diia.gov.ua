<?php namespace KitSoft\Faq\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateQuestionsRelatedTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_faq_questions_related', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('question_id')->unsigned();
            $table->integer('related_id')->unsigned();

            $table->foreign('question_id')
                ->references('id')->on('kitsoft_faq_questions')
                ->onDelete('cascade');
            $table->foreign('related_id')
                ->references('id')->on('kitsoft_faq_questions')
                ->onDelete('cascade');

            $table->primary(['question_id', 'related_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_faq_questions_related');
    }
}
