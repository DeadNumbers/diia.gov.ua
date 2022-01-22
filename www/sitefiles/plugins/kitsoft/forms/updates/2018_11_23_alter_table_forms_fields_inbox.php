<?php namespace KitSoft\Forms\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AlterTableFormsFieldsInbox extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_forms_forms', function(Blueprint $table) {
            $table->boolean('is_system')->default(false);
            $table->integer('template_id')->nullable()->change();
        });

        Schema::table('kitsoft_forms_fields', function(Blueprint $table) {
            $table->string('code')->nullable()->change();
        });

        Schema::table('kitsoft_forms_inbox', function(Blueprint $table) {
            $table->string('status', 20)->default('new')->index();
        });
    }

    public function down()
    {

    }
}
