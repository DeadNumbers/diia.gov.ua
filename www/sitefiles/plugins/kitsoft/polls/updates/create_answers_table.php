<?php namespace KitSoft\Polls\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_polls_answers', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 255);
            $table->text('text');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_polls_answers');
    }
}
