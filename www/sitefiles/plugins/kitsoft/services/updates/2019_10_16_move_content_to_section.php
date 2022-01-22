<?php namespace KitSoft\Services\Updates;

use KitSoft\Pages\Models\Section;
use KitSoft\Services\Models\Service;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class MoveContentToSection extends Migration
{
    public function up()
    {
        Service::withoutGlobalScopes()->chunk(100, function ($items) {
            $items->each(function ($item) {
                if (!isset($item->attributes['content'])) {
                    return;
                }


                $section = Section::make();
                $section->published = true;
                $section->title = 'Сервіс - Контент';
                $section->name = 'serviceContent';
                $section->fields = [
                    'content' => $item->attributes['content']
                ];
                $section->sort_order = 1;
                
                $section->save();

                $item->sections()->sync([$section->id]);
            });
        });

        Schema::table('kitsoft_services_services', function (Blueprint $table) {
            $table->dropColumn('content');
        });
    }
}
