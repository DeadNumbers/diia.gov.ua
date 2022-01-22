<?php namespace KitSoft\Services\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AlterCategoriesTableAddIsTop extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_services_categories', function (Blueprint $table) {
            $table->boolean('is_top')->default(true)->index();
        });
    }

    public function down()
    {
    }
}