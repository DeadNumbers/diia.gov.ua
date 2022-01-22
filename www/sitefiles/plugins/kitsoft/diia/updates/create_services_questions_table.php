<?php namespace KitSoft\Diia\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateServicesQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_services_services_questions', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('service_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->primary(['service_id', 'question_id']);

            $table->foreign('service_id')
                ->references('id')->on('kitsoft_services_services')
                ->onDelete('cascade');

            $table->foreign('question_id')
                ->references('id')->on('kitsoft_faq_questions')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_services_services_questions');
    }
}
