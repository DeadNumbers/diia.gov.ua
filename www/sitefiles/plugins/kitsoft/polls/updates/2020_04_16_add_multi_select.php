<?php namespace KitSoft\Polls\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class AddMultiSelect extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_polls_questions', function (Blueprint $table) {
            $table->enum('type', ['radio', 'checkbox', 'select'])->default('radio');
        });
    }

    public function down()
    {
    }
}

