<?php namespace KitSoft\Polls\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class AddPollsLogsAndComments extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_polls_options', function (Blueprint $table) {
            $table->boolean('comment')->default(false);
            $table->boolean('comment_is_required')->default(false);
            $table->string('comment_placeholder', 255)->nullable();
        });

        Schema::create('kitsoft_polls_logs', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('poll_id')->nullable();
            $table->text('log');
            $table->string('ip', 45);
            $table->timestamps();
        });
    }

    public function down()
    {
    }
}

