<?php namespace KitSoft\Services\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AlterTableServicesActionHits extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_services_services', function (Blueprint $table) {
            $table->integer('action_hits')->unsigned()->default(0);
        });
    }

    public function down()
    {
    }
}