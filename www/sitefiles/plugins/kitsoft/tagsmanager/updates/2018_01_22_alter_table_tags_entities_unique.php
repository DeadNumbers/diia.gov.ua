<?php namespace KitSoft\TagsManager\Updates;

use Db;
use KitSoft\TagsManager\Models\Entity;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class AlterTableTagsEntitiesUnique extends Migration
{
    private $tagsTable, $tagsTableTmp;

    public function __construct()
    {
        $this->tagsTable = (new Entity())->getTable();
        $this->tagsTableTmp = "{$this->tagsTable}_tmp";
    }

    public function up()
    {
        Schema::table($this->tagsTable, function(Blueprint $table) {
            $table->dropIndex(['tag_id', 'entity_id', 'entity_type']);
        });

        Db::select("ALTER TABLE {$this->tagsTable} RENAME TO {$this->tagsTableTmp}");

        Schema::create($this->tagsTable, function (Blueprint $table) {
            $table->integer('tag_id')->unsigned()->nullable()->default(null);
            $table->integer('entity_id')->unsigned()->nullable()->default(null);
            $table->string('entity_type')->nullable();

            $table->index(['tag_id', 'entity_id', 'entity_type']);
            $table->unique(['tag_id', 'entity_id', 'entity_type']);
        });

        Db::select("INSERT INTO {$this->tagsTable} SELECT DISTINCT * FROM {$this->tagsTableTmp}");
        Db::select("DROP TABLE {$this->tagsTableTmp}");
    }

    public function down()
    {
    }
}
