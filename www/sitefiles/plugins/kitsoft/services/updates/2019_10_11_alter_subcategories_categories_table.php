<?php namespace KitSoft\Services\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AlterSubcategoriesCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_services_subcategories_categories', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned()->nullable();
        });
    }

    public function down()
    {
    }
}