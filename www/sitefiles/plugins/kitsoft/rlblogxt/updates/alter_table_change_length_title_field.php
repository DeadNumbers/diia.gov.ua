<?php namespace KitSoft\RLBlogXT\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AlterTableChangeLengthTitleField extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function (Blueprint $table) {
            $table->string('title', 500)->change();
        });
    }

    public function down()
    {
        Schema::table('rainlab_blog_posts', function (Blueprint $table) {
            $table->string('title', 255)->change();
        });
    }
}
