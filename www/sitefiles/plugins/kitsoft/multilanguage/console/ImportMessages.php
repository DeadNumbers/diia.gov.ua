<?php namespace KitSoft\MultiLanguage\Console;

use Db;
use Illuminate\Console\Command;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\Multilanguage\Models\Message;
use Schema;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ImportMessages extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'multilanguage:importmessages';

    /**
     * @var string The console command description.
     */
    protected $description = 'No description provided yet...';

    protected $inserted = 0;
    protected $defaultLocale;

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $this->output->writeln("Start!");

        if (!Schema::hasTable('rainlab_translate_messages')) {
            $this->output->writeln("Table 'rainlab_translate_messages' not exist.");
            return;
        }

        $this->defaultLocale = MultiLanguage::instance()->getDefaultLocale();

        Db::table('rainlab_translate_messages')->orderBy('id')->chunk(500, function ($items) {
            $items->each(function ($item) {
                $translates = json_decode($item->message_data, true);
                $translates[$this->defaultLocale] = $translates[$this->defaultLocale] ?? $translates['x'];
                unset($translates['x']);

                if (!Message::where('message', $item->code)->count()) {
                    $row = Message::make();
                    $row->message = $item->code;
                    $row->translates = $translates;
                    $row->save();

                    $this->inserted++;
                }
            });
        });

        $this->output->writeln("Inserted {$this->inserted} rows.");
    }
}
