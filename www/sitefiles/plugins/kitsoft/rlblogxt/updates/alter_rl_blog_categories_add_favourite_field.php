<?php namespace KitSoft\RLBlogXT\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AlterRLBlogCategoriesAddFavouriteField extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_categories', function (Blueprint $table) {
            $table->boolean('favourite')->default(true);
        });
    }

    public function down()
    {

    }
}