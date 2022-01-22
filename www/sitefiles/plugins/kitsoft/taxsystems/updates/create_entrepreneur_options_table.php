<?php namespace KitSoft\TaxSystems\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateEntrepreneurOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_taxsystems_entrepreneur_options', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->integer('entrepreneur_question_id')->unsigned()->index();
            $table->string('text')->nullable();
            $table->integer('hits')->unsigned()->default(0);
            $table->enum('type', ['label', 'option'])->default('option');
            $table->boolean('published')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('kitsoft_taxsystems_entrepreneur_options_tax_systems', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('tax_system_id')->unsigned();
            $table->integer('entrepreneur_option_id')->unsigned();
            $table->primary(['tax_system_id', 'entrepreneur_option_id']);

            $table->foreign('tax_system_id')
                ->references('id')->on('kitsoft_taxsystems_tax_systems')
                ->onDelete('cascade');

            $table->foreign('entrepreneur_option_id')
                ->references('id')->on('kitsoft_taxsystems_entrepreneur_options')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_taxsystems_entrepreneur_options_tax_systems');
        Schema::dropIfExists('kitsoft_taxsystems_entrepreneur_options');
    }
}
