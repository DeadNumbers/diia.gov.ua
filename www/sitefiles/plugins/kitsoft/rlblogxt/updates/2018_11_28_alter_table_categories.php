<?php namespace KitSoft\RLBlogXT\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AlterTableCategories extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('rainlab_blog_categories', 'fields')) {
            Schema::table('rainlab_blog_categories', function (Blueprint $table) {
                $table->text('fields')->nullable();
            });
        }
    }

    public function down()
    {
    }
}