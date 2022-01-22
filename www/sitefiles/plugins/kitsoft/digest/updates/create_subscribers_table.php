<?php namespace KitSoft\Digest\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateSubscribersTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_digest_subscribers', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('email')->index();
            $table->string('content_types')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->string('sync_id')->nullable();
            $table->string('sync_uuid')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_digest_subscribers');
    }
}
