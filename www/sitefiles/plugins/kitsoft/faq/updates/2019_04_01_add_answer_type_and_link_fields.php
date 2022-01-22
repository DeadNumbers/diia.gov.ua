<?php namespace KitSoft\Faq\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AddAnswerTypeAndLinkFields extends Migration
{
    private $table;

    public function __construct()
    {
        $this->table = 'kitsoft_faq_questions';
    }

    public function up()
    {
        if (!Schema::hasColumn($this->table, 'answer_type')){
            Schema::table($this->table, function (Blueprint $table) {
                $table->enum('answer_type', ['answer', 'link'])->default('answer');
            });
        }

        if (!Schema::hasColumn($this->table, 'link')){
            Schema::table($this->table, function (Blueprint $table) {
                $table->string('link')->nullable();
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn($this->table, 'answer_type')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('answer_type');
            });
        }

        if (Schema::hasColumn($this->table, 'link')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('link');
            });
        }
    }
}