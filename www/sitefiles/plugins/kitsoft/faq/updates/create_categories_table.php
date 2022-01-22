<?php namespace KitSoft\Faq\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_faq_categories', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->integer('nest_left')->nullable();
            $table->integer('nest_right')->nullable();
            $table->integer('nest_depth')->nullable();
            $table->timestamps();
        });

        Schema::create('kitsoft_faq_questions_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('question_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->foreign('question_id')
                ->references('id')->on('kitsoft_faq_questions')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')->on('kitsoft_faq_categories')
                ->onDelete('cascade');

            $table->primary(['question_id', 'category_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_faq_questions_categories');
        Schema::dropIfExists('kitsoft_faq_categories');
    }
}
