<?php namespace KitSoft\MultiLanguage\Updates;

use KitSoft\Multilanguage\Models\Message;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class AlterTableAddUniqueMessage extends Migration
{
    public function up()
    {
        Message::chunk(500, function ($items) {
            $items->each(function ($item) {
                Message::where('message', $item->message)->where('id', '<>', $item->id)->delete();
            });
        });
        Schema::table('kitsoft_multilanguage_messages', function($table)
        {
            $table->unique('message');
        });
    }

    public function down()
    {
    }
}
