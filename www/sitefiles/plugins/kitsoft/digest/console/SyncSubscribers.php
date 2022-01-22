<?php namespace KitSoft\Digest\Console;

use Illuminate\Console\Command;
use KitSoft\Digest\Models\ListSync;
use KitSoft\Digest\Models\Subscriber;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class SyncSubscribers extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'digest:syncsubscribers';

    /**
     * @var string The console command description.
     */
    protected $description = '';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        if (!$list_id = $this->option('list_id')) {
            dd('List id is not set.');
        }

        $list = ListSync::find($list_id);

        $this->output->writeln("List code: {$list->code}.");

        $query = Subscriber::make();

        if ($onlyNotSynced = $this->option('only_not_synced')) {
            $this->output->writeln("Only not synced filter accepted.");
            $query = $query->whereNull('sync_id');
        }

        $this->output->writeln("Sync start!\n");

        $query->chunk(100, function ($items) use ($list) {
            $items->each(function ($item) use ($list) {
                $this->output->writeln("Subscriber ID: {$item->id}");
                $item->lists = [
                    $list->id
                ];
                $item->save();
            });
            // hack besause phplist has limit 1200 requests per minute
            sleep(60);
        });

        $this->output->writeln("\nComplete!");
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['list_id', 'list_id', InputOption::VALUE_OPTIONAL, 'SyncList ID', null],
            ['only_not_synced', 'only_not_synced', InputOption::VALUE_OPTIONAL, '1', null]
        ];
    }
}
