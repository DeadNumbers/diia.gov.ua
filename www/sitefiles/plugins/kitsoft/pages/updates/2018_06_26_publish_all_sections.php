<?php namespace KitSoft\Pages\Updates;

use KitSoft\Pages\Models\Section;
use October\Rain\Database\Updates\Migration;

class PublishAllSections extends Migration
{
    public function up()
    {
        Section::all()->each(function ($item) {
            $item->published = true;
            $item->save();
        });
    }

    public function down()
    {
        
    }
}
