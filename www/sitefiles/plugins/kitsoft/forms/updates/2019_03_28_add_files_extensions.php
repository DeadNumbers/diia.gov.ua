<?php namespace KitSoft\Forms\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AddFilesExtensions extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_forms_fields', function(Blueprint $table) {
            $table->string('file_extensions')->nullable();
        });
    }

    public function down()
    {

    }
}
