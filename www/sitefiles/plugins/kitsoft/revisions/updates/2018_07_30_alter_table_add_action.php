<?php namespace KitSoft\Revisions\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AlterTableAddAction extends Migration
{
    public function up()
    {
        Schema::table('system_revisions', function(Blueprint $table) {
			$table->string('action')->nullable();
			$table->string('group')->nullable();
        });
    }

    public function down()
    {
        
    }
}