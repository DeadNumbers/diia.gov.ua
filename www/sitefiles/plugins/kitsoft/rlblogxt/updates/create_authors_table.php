<?php namespace KitSoft\RLBlogXT\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateAuthorsTable extends Migration
{

    public function up()
    {
        Schema::create('kitsoft_rlblogxt_authors', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->index();
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->integer('nest_left')->nullable();
            $table->integer('nest_right')->nullable();
            $table->integer('nest_depth')->nullable();
            $table->timestamps();
        });

        Schema::create('kitsoft_rlblogxt_posts_authors', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('post_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->primary(['post_id', 'author_id']);
        });
    }

    public function down()
    {
        Schema::drop('kitsoft_rlblogxt_authors');
        Schema::drop('kitsoft_rlblogxt_posts_authors');
    }

}
