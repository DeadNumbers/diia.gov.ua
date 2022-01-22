<?php namespace KitSoft\Pages\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AlterTableSystemFiles extends Migration
{
    public function up()
    {
        Schema::table('system_files', function(Blueprint $table) {
			$table->enum('field_type', ['fileupload', 'mediafinder'])->default('fileupload');
        });
    }

    public function down()
    {
        
    }
}