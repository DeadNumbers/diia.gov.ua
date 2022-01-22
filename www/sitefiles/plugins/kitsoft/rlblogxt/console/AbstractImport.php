<?php namespace KitSoft\RLBlogXT\Console;

use Illuminate\Console\Command;
use KitSoft\MultiSite\Classes\MultiSite;
use KitSoft\RLBlogXT\Classes\ImportHelpers as BlogImportHelpers;
use League\Csv\Reader;
use Symfony\Component\Console\Input\InputOption;
use System\Classes\PluginManager;

abstract class AbstractImport extends Command
{
    protected $name;
    protected $description;
    protected $slugMaxLength = 191;
    protected $csvDelimiter;
    protected $csvEnclosure;
    protected $csvEscape;

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['site_id', 'site_id', InputOption::VALUE_OPTIONAL, '1', null],
            ['filepath', 'filepath', InputOption::VALUE_REQUIRED, 'Csv filepath for import.', null],
            ['old_host', 'old_host', InputOption::VALUE_OPTIONAL, 'Old host'],
        ];
    }

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        if (!$this->filepath = $this->option('filepath')) {
            dd('Option filepath is not set.');
        }

        if (!$this->option('old_host')) {
            dd('old_host option is not set');
        }

        $this->setSite();

        if (!file_exists(base_path($this->filepath))) {
            dd('File not exist.');
        }

        $this->output->writeln("Import was started!\n");
        $this->createItems();
        $this->output->writeln("\nComplete!");
    }

    /**
     * setSite
     */
    protected function setSite()
    {
        if (!PluginManager::instance()->hasPlugin('KitSoft.MultiSite')) {
            return;
        }
        if (!$siteId = $this->option('site_id')) {
            dd('Option site_id is not set.');
        }

        $site = MultiSite::instance();
        $site->reinitSite($siteId);

        if (!$site->getCurrentSite()) {
            dd("Site with ID {$siteId} not found.");
        }
    }

    /**
     * createItems
     */
    protected function createItems()
    {
        ini_set('memory_limit', '-1');
        $this->importStream();
    }

    /**
     * getSlug
     */
    protected function getSlug($data)
    {
        $data = ltrim($data, '/');
        $data = rtrim($data, '/');

        if (strlen($data) > $this->slugMaxLength) {
            $data = substr($data, 0, $this->slugMaxLength - 14) . '-' . uniqid();
        }

        return str_replace('/', '-', $data);
    }

    /**
     * importStream
     */
    protected function importStream()
    {
        if (!file_exists($this->filepath)) {
            dd('File not exist');
        }

        $reader = Reader::createFromPath($this->filepath, 'r');

        // Filter out empty rows
        $reader->addFilter(function (array $row) {
            return count($row) > 1 || reset($row) !== null;
        });

        if ($this->csvDelimiter) {
            $reader->setDelimiter($this->csvDelimiter);
        }

        if ($this->csvEnclosure) {
            $reader->setEnclosure($this->csvEnclosure);
        }

        if ($this->csvEscape) {
            $reader->setEscape($this->csvEscape);
        }

        $matches = $reader->fetchOne();

        $reader->setOffset(1)->each(function ($item, $key) use ($matches) {
            $this->output->writeln("Iteration - {$key}: Creating post");

            $data = $this->importStreamRow($item, $matches);

            $this->createItem($data);

            return true;
        });
    }

    /**
     * Converts a single row of CSV data to the column map.
     * @return array
     */
    protected function importStreamRow($rowData, $matches)
    {
        $newRow = [];

        foreach ($matches as $columnIndex => $dbNames) {
            $value = array_get($rowData, $columnIndex);
            foreach ((array) $dbNames as $dbName) {
                $newRow[$dbName] = $value;
            }
        }

        return $newRow;
    }

    /**
     * getTags
     */
    protected function getTags($item)
    {
        if (!PluginManager::instance()->hasPlugin('KitSoft.TagsManager')) {
            return [];
        }

        if (!isset($item['tags'])) {
            return;
        }

        $tags = json_decode($item['tags'], true) ?? [];

        $tagsIds = [];
        foreach ($tags as $slug => $name) {
            $tagsIds[] = BlogImportHelpers::getOrCreateTag($name, $slug)->id;
        }

        return $tagsIds;
    }

    /**
     * getContent
     */
    protected function getContent($content)
    {
        $content = $this->parseImages($content);
        $content = $this->parseLinks($content);

        return $content;
    }
}
