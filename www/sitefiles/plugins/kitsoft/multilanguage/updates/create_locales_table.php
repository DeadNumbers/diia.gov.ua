<?php namespace KitSoft\MultiLanguage\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use KitSoft\MultiLanguage\Models\Locale;

class CreateLocalesTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_multilanguage_locales', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code')->index();
            $table->string('name')->index()->nullable();
            $table->string('label')->index()->nullable();
            $table->boolean('is_default')->default(0);
            $table->boolean('is_enabled')->default(0);
            $table->integer('sort_order')->unsigned()->nullable()->index();
        });

        Locale::create([
            'code' => 'ua',
            'name' => 'Ukraine',
            'label' => 'Українською',
            'is_default' => true,
            'is_enabled' => true
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_multilanguage_locales');
    }
}
