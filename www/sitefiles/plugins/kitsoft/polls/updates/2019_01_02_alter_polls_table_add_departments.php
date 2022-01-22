<?php namespace KitSoft\Polls\Updates;

use KitSoft\Polls\Models\Option;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class AlterPollsTableAddDepartments extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_polls_polls', function (Blueprint $table) {
            $table->boolean('use_departments')->default(false);
        });
    }

    public function down()
    {
    }
}

