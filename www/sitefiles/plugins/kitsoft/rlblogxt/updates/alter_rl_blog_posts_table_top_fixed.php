<?php namespace KitSoft\RLBlogXT\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AlterRLBlogPostsTableTopFixed extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function (Blueprint $table) {
            $table->boolean('is_top')->default(false);
            $table->boolean('is_fixed')->default(false);
        });
    }

    public function down()
    {

    }
}