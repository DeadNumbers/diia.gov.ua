<?php namespace KitSoft\MultiLanguage\Updates;

use Artisan;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\MultiLanguage\Console\MakeEntities;
use KitSoft\MultiLanguage\Models\Entity;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class MakeEntitiesForMail extends Migration
{
    protected $inserted;
    protected $defaultLocale;

    protected $models = [
        '\System\Models\MailPartial',
        '\System\Models\MailLayout',
        '\System\Models\MailTemplate',
    ];

    public function up()
    {
        $this->defaultLocale = MultiLanguage::instance()->getDefaultLocale();

        foreach ($this->models as $model) {
            $this->inserted = 0;
            $model = new $model;
            $model->newQueryWithoutScopes()->chunk(500, function ($items) {
                $items->each(function ($item) {
                    $entity = Entity::where('entity_type', get_class($item))
                        ->where('entity_id', $item->id)
                        ->where('locale', $this->defaultLocale)
                        ->count();
                    if($entity) {
                        return;
                    }

                    Entity::insert([
                        'locale' => $this->defaultLocale,
                        'entity_id' => $item->id,
                        'relation_id' => $item->id,
                        'entity_type' => get_class($item)
                    ]);
                    $this->inserted++;
                });
            });

            echo(get_class($model) . ". Inserted {$this->inserted} entities.\n");
        }
    }

    public function down()
    {
        
    }
}
