<?php namespace KitSoft\Faq\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_faq_questions', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('question');
            $table->text('answer')->nullable();
            $table->boolean('published')->default(false);
            $table->text('fields')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_faq_questions');
    }
}
