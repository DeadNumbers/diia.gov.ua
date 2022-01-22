<?php namespace KitSoft\Polls\Updates;

use Db;
use KitSoft\Polls\Models\Log;
use KitSoft\Polls\Models\Option;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class CreateOptionLogsTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_polls_option_logs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('option_id')->index();
            $table->timestamps();

            $table->foreign('option_id')
                ->references('id')->on('kitsoft_polls_options')
                ->onDelete('cascade');
        });

        // export options logs from poll logs
        if (Db::table('kitsoft_polls_logs')->count()) {
            Log::chunk(50, function ($items) {
                $items->each(function ($item) {
                    foreach ($item->log as $row) {
                        if (!isset($row['options'])) {
                            continue;
                        }
                        foreach ($row['options'] as $row) {
                            Option::find($row['id'])->logs()->create([
                                'created_at' => $item->created_at,
                                'updated_at' => $item->updated_at,
                            ]);
                        }
                    }
                });
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_polls_option_logs');
    }
}
