<?php namespace KitSoft\Search\Console;

use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\Search\Classes\ElasticClient;
use KitSoft\Search\Classes\Helpers;
use KitSoft\Search\Console\AbstractElastic;
use KitSoft\Search\Console\Interfaces\ElasticCommandInterface;

class ElasticRefresh extends AbstractElastic implements ElasticCommandInterface
{
    /**
     * @var string The console command name.
     */
    protected $name = 'search:elastic-refresh';

    /**
     * runLocale
     */
    public function runLocale(string $locale): void
    {
        $this->getProviders()->each(function ($item, $type) use ($locale) {
            try {
                if (!$index = Helpers::getElasticIndex($type)) {
                    $this->error("Index for {$type} {$locale} is empty!");
                    return;
                }
            
                $client = new ElasticClient();

                if ($client->checkIndexExist(['index' => $index])) {
                    $client->deleteIndex(['index' => $index]);
                    $this->info($index);
                } else {
                    $this->error($index);
                }
            } catch (Exception $e) {
                $this->error($e->getMessage());
            }
        });
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
