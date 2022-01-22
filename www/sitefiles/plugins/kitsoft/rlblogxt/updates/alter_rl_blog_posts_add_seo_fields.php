<?php namespace KitSoft\RLBlogXT\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AlterRLBlogPostsAddSeoFields extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function (Blueprint $table) {
            $table->string('meta_title')->default('');
            $table->string('meta_h1')->default('');
            $table->string('meta_description', 500)->default('');
            $table->string('meta_keywords')->default('');
        });
    }

    public function down()
    {

    }
}