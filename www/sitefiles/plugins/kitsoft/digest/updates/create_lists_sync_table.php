<?php namespace KitSoft\Digest\Updates;

use KitSoft\Digest\Models\ListSync;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class CreateListsSyncTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_digest_lists_sync', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('code')->index();
            $table->boolean('system')->default(false);
            $table->string('sync_id')->nullable();
            $table->timestamps();
        });

        Schema::create('kitsoft_digest_subscribers_lists', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('subscriber_id')->unsigned();
            $table->integer('list_id')->unsigned();

            $table->foreign('subscriber_id')
                ->references('id')->on('kitsoft_digest_subscribers')
                ->onDelete('cascade');
            $table->foreign('list_id')
                ->references('id')->on('kitsoft_digest_lists_sync')
                ->onDelete('cascade');

            $table->primary(['subscriber_id', 'list_id']);
        });

        $this->createList([
            'title' => 'Раз на день',
            'code' => 'per_day'
        ]);

        $this->createList([
            'title' => 'Раз на тиждень',
            'code' => 'per_week'
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_digest_lists_sync');
        Schema::dropIfExists('kitsoft_digest_subscribers_lists');
    }

    /**
     * createList
     */
    protected function createList(array $attributes)
    {
        $object = ListSync::make();
        $object->attributes = $attributes;
        $object->system = true;
        $object->save();
    }
}
