<?php namespace KitSoft\Polls\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class AlterPollsTable extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_polls_polls', function (Blueprint $table) {
            $table->text('info')->nullable();
        });
    }

    public function down()
    {
    }
}

