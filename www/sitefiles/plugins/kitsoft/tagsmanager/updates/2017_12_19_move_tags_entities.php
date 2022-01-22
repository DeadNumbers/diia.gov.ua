<?php namespace KitSoft\TagsManager\Updates;

use Db;
use KitSoft\TagsManager\Models\Entity;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class MoveTagsEntities extends Migration
{
    protected $entitiesTable = 'kitsoft_tagsmanager_entities';

    protected $models = [
        'KitSoft\NPA\Models\Act' => 'kitsoft_tagsmanager_tags_acts',
        'KitSoft\Events\Models\Event' => 'kitsoft_tagsmanager_tags_events',
        'KitSoft\MediaGallery\Models\MediaGallery' => 'kitsoft_tagsmanager_tags_media_galleries',
        'KitSoft\Meetings\Models\Meeting' => 'kitsoft_tagsmanager_tags_meetings',
        'KitSoft\Ministries\Models\Ministry' => 'kitsoft_tagsmanager_tags_ministries',
        'KitSoft\Pages\Models\Page' => 'kitsoft_tagsmanager_tags_pages',
        'KitSoft\Persons\Models\Person' => 'kitsoft_tagsmanager_tags_persons',
        'KitSoft\Projects\Models\Project' => 'kitsoft_tagsmanager_tags_projects',
        'RainLab\Blog\Models\Post' => 'kitsoft_tagsmanager_tags_posts',
        'Graker\PhotoAlbums\Models\Album' => 'kitsoft_tagsmanager_tags_albums',
    ];

    public function up()
    {
        foreach($this->models as $model => $table) {
            if(!class_exists($model) || !Schema::hasTable($table)) {
                continue;
            }

            Db::table($table)->orderBy('tag_id')->chunk(500, function ($items) use ($model, $table) {
                $items->each(function ($item) use ($model, $table) {
                    $entityName = snake_case(class_basename($model)) . '_id';

                    $entity = Entity::make();
                    $entity->tag_id = $item->tag_id;
                    $entity->entity_id = $item->$entityName;
                    $entity->entity_type = $model;
                    $entity->save();
                });
            });

            Schema::dropIfExists($table);
        }
        
    }

    public function down()
    {
    }
}
