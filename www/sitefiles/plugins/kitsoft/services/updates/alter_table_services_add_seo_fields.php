<?php namespace KitSoft\Services\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AlterTableServicesAddSeoFields extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_services_services', function (Blueprint $table) {
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('og_image')->nullable();
        });
    }

    public function down()
    {
    }
}