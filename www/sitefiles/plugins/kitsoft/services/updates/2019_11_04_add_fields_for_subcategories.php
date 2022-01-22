<?php namespace KitSoft\Services\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AddFieldsToSubcategories extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_services_subcategories', function (Blueprint $table) {
            $table->text('fields')->nullable();
        });
    }

    public function down()
    {
    }
}