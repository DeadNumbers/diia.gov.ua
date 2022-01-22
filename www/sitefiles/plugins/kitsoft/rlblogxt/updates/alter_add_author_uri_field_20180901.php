<?php namespace KitSoft\RLBlogXT\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AddAuthorUri extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_rlblogxt_authors', function (Blueprint $table) {
            $table->string('uri')->nullable();
        });
    }

    public function down()
    {
    }
}