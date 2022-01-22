<?php namespace KitSoft\Polls\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class AlterAnswersTable extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_polls_answers', function (Blueprint $table) {
            $table->text('title')->change();
        });
    }

    public function down()
    {
    }
}

