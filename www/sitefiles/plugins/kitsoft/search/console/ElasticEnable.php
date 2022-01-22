<?php namespace KitSoft\Search\Console;

use Config;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\Search\Console\AbstractElastic;
use KitSoft\Search\Console\Interfaces\ElasticCommandInterface;
use KitSoft\Search\Models\Settings;
use Symfony\Component\Console\Input\InputOption;

class ElasticEnable extends AbstractElastic implements ElasticCommandInterface
{
    /**
     * @var string The console command name.
     */
    protected $name = 'search:elastic-enable';

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return array_merge(parent::getOptions(), [
            ['host', 'host', InputOption::VALUE_OPTIONAL],
            ['login', 'login', InputOption::VALUE_OPTIONAL],
            ['password', 'password', InputOption::VALUE_OPTIONAL]
        ]);
    }

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        if (!$this->option('host')) {
            $this->error('Host option is required.');
            die;
        }

        parent::handle();
    }

    /**
     * runLocale
     */
    public function runLocale(string $locale): void
    {
        $settings = Settings::instance();

        $login = $this->option('login');
        $password = $this->option('password');
        
        if ($login && $password) {
            $settings->elastic_auth = true;
            $settings->elastic_login = $login;
            $settings->elastic_password = $password;
        }

        if ($host = $this->option('host')) {
            $settings->elastic_host = $host;
        }

        $settings->elastic_analyzer = Config::get('kitsoft.search::analyzers.' . $locale);
        $settings->is_elastic = true;
        $settings->elastic_events = true;
        $settings->elastic_per_page = 10;
        $settings->elastic_max_items_limit = 20000;

        $settings->save();

        $this->info($locale);
    }

    /**
     * runMultiLanguage
     */
    public function runMultiLanguage(): void
    {
        $this->loadLocales()->each(function ($locale) {
            MultiLanguage::instance()->setLocale($locale->code);

            $this->runLocale($locale->code);
        });
    }
}
