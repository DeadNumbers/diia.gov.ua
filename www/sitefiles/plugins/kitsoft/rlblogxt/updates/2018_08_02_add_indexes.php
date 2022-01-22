<?php namespace KitSoft\RLBlogXT\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AddIndexesFixedTop extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function (Blueprint $table) {
            $table->index(['is_fixed', 'is_top', 'published_at']);
        });
    }

    public function down()
    {
    }
}