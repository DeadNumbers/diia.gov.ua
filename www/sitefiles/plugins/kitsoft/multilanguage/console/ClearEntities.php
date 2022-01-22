<?php namespace KitSoft\MultiLanguage\Console;

use Db;
use Illuminate\Console\Command;
use KitSoft\MultiLanguage\Models\Entity;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ClearEntities extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'multilanguage:clearentities';

    /**
     * @var string The console command description.
     */
    protected $description = 'No description provided yet...';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $this->output->writeln('Start!');

        Entity::orderBy('entity_id')->chunk(500, function ($items) {
            $items->each(function ($item) {
                $model = $item->entity_type::where('id', $item->entity_id)
                    ->count();

                if(!$model) {
                    $this->output->writeln('Deleting item: ' . $item->entity_type . ' ' . $item->entity_id);
                    Entity::where('entity_type', $item->entity_type)
                        ->where('entity_id', $item->entity_id)
                        ->where('locale', $item->locale)
                        ->where('relation_id', $item->relation_id)
                        ->delete();
                }
            });
        });

        Db::select('CREATE TABLE kitsoft_multilanguage_entities_temp as SELECT DISTINCT * FROM kitsoft_multilanguage_entities');
        Db::select('ALTER TABLE kitsoft_multilanguage_entities RENAME TO kitsoft_multilanguage_entities_junk');
        Db::select('ALTER TABLE kitsoft_multilanguage_entities_temp RENAME TO kitsoft_multilanguage_entities');
        Db::select('DROP TABLE kitsoft_multilanguage_entities_junk');

        $this->output->writeln('Complete!');
    }
}
