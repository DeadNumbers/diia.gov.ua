<?php namespace KitSoft\RLBlogXT\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AlterAddHitsField extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function (Blueprint $table) {
            $table->integer('hits')->default(0);
        });
    }

    public function down()
    {
    }
}