<?php namespace KitSoft\Search\Console;

use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\Search\Classes\Helpers;
use KitSoft\Search\Console\AbstractElastic;
use KitSoft\Search\Console\Interfaces\ElasticCommandInterface;
use Queue;

class ElasticReindex extends AbstractElastic implements ElasticCommandInterface
{
    /**
     * @var string The console command name.
     */
    protected $name = 'search:elastic-reindex';

    /**
     * runLocale
     */
    public function runLocale(string $locale): void
    {
        Helpers::getProvidersCollection()->each(function ($item, $type) use ($locale) {
            $this->reindex($type, $item, $locale);
        });
    }

    /**
     * runMultiLanguage
     */
    public function runMultiLanguage(): void
    {
        $this->loadLocales()->each(function ($locale) {
            MultiLanguage::instance()->setLocale($locale->code);
            Helpers::getProvidersCollection()->each(function ($item, $type) use ($locale) {
                $this->reindex($type, $item, $locale->code);
            });
        });
    }

    /**
     * reindex
     */
    protected function reindex(string $type, array $config, string $locale)
    {
        Queue::push(
            'KitSoft\Search\Jobs\ElasticRebuild@fire',
            [
                'type' => $type,
                'mappings' => $config['mappings'] ?? [],
                'settings' => $config['settings'] ?? [],
                'files' => $config['files'] ?? [],
                'dynamicAttributes' => $config['dynamicAttributes'] ?? [],
                'index_name' => Helpers::getElasticIndex($type),
                'lang' => $locale
            ]
        );
    }
}
