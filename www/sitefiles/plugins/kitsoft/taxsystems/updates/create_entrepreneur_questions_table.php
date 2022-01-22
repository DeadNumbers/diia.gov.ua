<?php namespace KitSoft\TaxSystems\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateEntrepreneurQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_taxsystems_entrepreneur_questions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->string('title')->nullable();
            $table->string('slug')->index();
            $table->boolean('published')->default(false);
            $table->enum('type', ['select', 'radio', 'checkbox'])->default('radio');
            $table->text('content')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_taxsystems_entrepreneur_questions');
    }
}
