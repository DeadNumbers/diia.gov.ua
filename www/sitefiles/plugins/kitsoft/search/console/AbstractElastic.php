<?php namespace KitSoft\Search\Console;

use Db;
use Illuminate\Console\Command;
use KitSoft\MultiLanguage\Models\Locale;
use KitSoft\Search\Classes\Helpers;
use Symfony\Component\Console\Input\InputOption;
use System\Classes\PluginManager;

abstract class AbstractElastic extends Command
{
	protected $defaultLocale = 'ua';

	/**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['include', 'include', InputOption::VALUE_OPTIONAL],
            ['exclude', 'exclude', InputOption::VALUE_OPTIONAL]
        ];
    }

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $this->output->writeln('Start!');

        Db::beginTransaction();

        try {
            if (PluginManager::instance()->hasPlugin('KitSoft.MultiLanguage')) {
                $this->runMultiLanguage();
            } else {
                $this->runLocale($this->defaultLocale);
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
            Db::rollback();
            return;
        }
        
        Db::commit();

        $this->info('Complete!');
    }

    /**
     * getProviders
     */
    protected function getProviders()
    {
        return Helpers::getProvidersCollection()->filter(function ($item) {
            return !isset($item['index'], $item['template']);
        });
    }

    /**
     * loadLocales
     */
    protected function loadLocales()
    {
    	$query = Locale::make();

        if ($include = $this->option('include')) {
            $query = $query->whereIn('code', explode(',', $include));
        }

        if ($exclude = $this->option('exclude')) {
            $query = $query->whereNotIn('code', explode(',', $exclude));
        }

        return $query->get();
    }
}
