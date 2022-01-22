<?php namespace KitSoft\MultiLanguage\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_multilanguage_messages', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('message')->index();
            $table->text('translates')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_multilanguage_messages');
    }
}
