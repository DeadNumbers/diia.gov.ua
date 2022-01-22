<?php namespace KitSoft\MultiLanguage\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AddIndexes extends Migration
{
    public function up()
    {
        Schema::table('kitsoft_multilanguage_entities', function (Blueprint $table) {
            $table->dropIndex('kitsoft_multilanguage_entities_entity_type_index');
            $table->dropIndex('kitsoft_multilanguage_entities_locale_index');
            $table->index(['entity_id', 'entity_type', 'locale']);
        });
    }

    public function down()
    {

    }
}
