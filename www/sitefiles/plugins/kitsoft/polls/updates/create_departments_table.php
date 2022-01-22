<?php namespace KitSoft\Polls\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_polls_departments', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 255);
            $table->string('slug', 255)->index();
            $table->text('text')->nullable();
            $table->timestamps();
        });

        Schema::create('kitsoft_polls_departments_answers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('department_id')->unsigned();
            $table->integer('answer_id')->unsigned();
            $table->primary(['department_id', 'answer_id']);

            $table->foreign('department_id')
                ->references('id')->on('kitsoft_polls_departments')
                ->onDelete('cascade');

            $table->foreign('answer_id')
                ->references('id')->on('kitsoft_polls_answers')
                ->onDelete('cascade');
        });

        Schema::create('kitsoft_polls_departments_locations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('department_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->primary(['department_id', 'location_id']);

            $table->foreign('department_id')
                ->references('id')->on('kitsoft_polls_departments')
                ->onDelete('cascade');

            $table->foreign('location_id')
                ->references('id')->on('kitsoft_polls_locations')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_polls_departments_answers');
        Schema::dropIfExists('kitsoft_polls_departments_locations');
        Schema::dropIfExists('kitsoft_polls_departments');
    }
}
