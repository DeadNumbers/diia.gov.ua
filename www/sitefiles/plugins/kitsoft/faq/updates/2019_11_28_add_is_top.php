<?php namespace KitSoft\Faq\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AddIsTopCategoriesQuestions extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_faq_categories', function (Blueprint $table) {
            $table->boolean('is_top')->default(false)->index();
        });

        Schema::table('kitsoft_faq_questions', function (Blueprint $table) {
            $table->boolean('is_top')->default(false)->index();
        });
    }

    public function down()
    {
        Schema::table('kitsoft_faq_categories', function (Blueprint $table) {
            $table->dropColumn('is_top');
        });

        Schema::table('kitsoft_faq_questions', function (Blueprint $table) {
            $table->dropColumn('is_top');
        });
    }
}