<?php namespace KitSoft\Search\Console;

use Config;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\Search\Console\AbstractElastic;
use KitSoft\Search\Console\Interfaces\ElasticCommandInterface;
use KitSoft\Search\Models\Settings;
use Symfony\Component\Console\Input\InputOption;

class ElasticProviders extends AbstractElastic implements ElasticCommandInterface
{
    /**
     * @var string The console command name.
     */
    protected $name = 'search:elastic-providers';

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return array_merge(parent::getOptions(), [
            ['force', 'force', InputOption::VALUE_OPTIONAL]
        ]);
    }

    /**
     * runLocale
     */
    public function runLocale(string $locale): void
    {
        $this->getProviders()->each(function ($item, $type) use ($locale) {
            $this->setProviderSettings($locale, $type);
        });
    }

    /**
     * runMultiLanguage
     */
    public function runMultiLanguage(): void
    {
        $this->loadLocales()->each(function ($locale) {
            $this->getProviders()->each(function ($item, $type) use ($locale) {
                MultiLanguage::instance()->setLocale($locale->code);
                $this->setProviderSettings($locale->code, $type);
            });
        });
    }

    /**
     * setProviderSettings
     */
    protected function setProviderSettings(string $locale, string $type): void
    {
        $settings = Settings::instance();

        if (!$this->option('force') && isset($settings->{"{$type}_index"}, $settings->{"{$type}_template"})) {
            $this->error("{$type} for locale [{$locale}] already exist");
            return;
        }

        $settings->{"{$type}_index"} = strtolower(
            sprintf('%s_%s_%s', Config::get('app.name'), $locale, $type)
        );
        $settings->{"{$type}_template"} = strtolower(
            sprintf('template_%s_%s', Config::get('app.name'), $type)
        );

        $settings->save();

        $this->info("Locale: {$locale}. Type: {$type}.");
    }
}
