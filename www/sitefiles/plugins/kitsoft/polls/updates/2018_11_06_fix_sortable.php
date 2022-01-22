<?php namespace KitSoft\Polls\Updates;

use KitSoft\Polls\Models\Option;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class FixSortableOptions extends Migration
{
    public function up()
    {
        Option::withoutGlobalScopes()
            ->get()
            ->each(function($item) {
                if ($item->sort_order == 0) {
                    $item->sort_order = Option::withoutGlobalScopes()->max('sort_order') + 1;
                    $item->save();
                }
            });
    }

    public function down()
    {
    }
}

