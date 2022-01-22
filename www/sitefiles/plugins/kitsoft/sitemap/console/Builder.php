<?php namespace KitSoft\Sitemap\Console;

use Exception;
use Illuminate\Console\Command;
use KitSoft\Sitemap\Classes\Helpers;
use Storage;

/**
 * Generate Sitemaps for SingleSite/MultiSite/MultiLanguage
 */
class Builder extends Command
{
    protected $name = 'sitemap:build';

    /**
     * handle
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');

        $this->output->writeln('Start!');

        Storage::deleteDirectory('sitemap');
        Storage::makeDirectory('sitemap');

        try {
            Helpers::getBuilder()->build();
        } catch (Exception $e) {
            trace_log($e);
            $this->output->writeln('Error! ' . $e->getMessage());
            Storage::deleteDirectory('sitemap');

            return;
        }

        $this->output->writeln('Complete!');
    }
}