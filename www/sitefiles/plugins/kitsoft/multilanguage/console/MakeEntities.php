<?php namespace KitSoft\MultiLanguage\Console;

use Illuminate\Console\Command;
use KitSoft\Core\Classes\PluginHelpers;
use KitSoft\MultiLanguage\Models\Entity;
use KitSoft\MultiLanguage\Models\Locale;

class MakeEntities extends Command
{
    protected $name = 'multilanguage:makeentities';
    protected $description = 'No description provided yet...';
    protected $inserted;
    protected $defaultLocale;

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');

        $this->output->writeln('Start!');
        $this->defaultLocale = Locale::getDefault();

        PluginHelpers::getModelsExtendedWith('KitSoft.MultiLanguage.Behaviors.MultiLanguageModel')
            ->each(function ($items) {
                $items->each(function ($model) {
                    $this->inserted = 0;
                    $this->output->writeln("Model: {$model}");

                    $model::withoutGlobalScopes()->chunk(100, function ($items) {
                        $items->each(function ($item) {
                            $entity = Entity::make()
                                ->where('entity_id', $item->id)
                                ->where('entity_type', get_class($item))
                                ->first();
                                
                            if ($entity) {
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

                    $this->output->writeln("Inserted {$this->inserted} entities.");
                });
            });

        $this->output->writeln('Complete!');
    }
}
