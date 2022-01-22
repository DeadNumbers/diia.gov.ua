<?php namespace KitSoft\Core\Console;

use ReflectionClass;
use Illuminate\Console\Command;
use KitSoft\Core\Console\Interfaces\ContentGenerationInterface;
use Symfony\Component\Console\Input\InputOption;
use Exception;
use KitSoft\Core\Classes\PluginHelpers;
use DB;

class ContentGeneration extends Command
{
    /**
     * @var string The console command name.
     *
     * example php artisan content:generation --name=KitSoft.Events --type=Categories --count=10
     *
     */
    protected $name = 'content:generation';

    /**
     * @var string The console command description.
     */
    protected $description = 'Content generation';

    /**
     * getOptions
     */
    protected function getOptions()
    {
        return array(
            array('name', null, InputOption::VALUE_REQUIRED, 'The name of the plugin. Eg: AuthorName.PluginName'),
            array('type', null, InputOption::VALUE_REQUIRED, 'The type of the plugin model. Eg: Categories, Acts, Events...'),
            array('count', null, InputOption::VALUE_REQUIRED, 'count'),
            array('image', null, InputOption::VALUE_REQUIRED, 'For disable images')
        );
    }

    /**
     * handle
     */
    public function handle()
    {
        DB::beginTransaction();

        try {
            if (!$this->option('name')) {
                $this->generate();
            } elseif (!$type = $this->option('type')) {
                $this->generate($this->option('name'));
            } else {
                $this->generate($this->option('name'), $type);
            }
        } catch ( Exception $e ) {
            DB::rollback();
            $this->error($e->getMessage());
            return;
        }
        DB::commit();
        $this->line("Generation end");
    }

    /**
     * generate
     */
    protected function generate(string $plugin = null, string $type = null)
    {
        $this->getFakersList($plugin, $type)->each(function($item) {
            $faker = new $item($this->option('count'));
            if ($this->option('image') === 'false') {
                $faker->disableImages();
            }
            $faker->run();
        });
    }

    /**
     * getFakersList
     */
    protected function getFakersList(string $plugin = null, string $type = null)
    {
        return PluginHelpers::getAllPlugins()
            ->filter(function ($item, $key) use ($plugin) {
                if (!$plugin) {
                    return true;
                }
                return ($key == $plugin);
            })
            ->transform(function($item, $key) use ($type) {
                $path = explode('.', $key);
                $fakerPath = plugins_path(strtolower($path[0]) . "/" . strtolower($path[1]) . "/faker");
                $files = glob("{$fakerPath}/*.php");
                if (!count($files)) {
                    return;
                }
                $this->line("Files exists in $key");
                return collect($files)
                    ->filter(function ($item) use ($type) {
                        if (!$type) {
                            return true;
                        }
                        return $type == pathinfo($item, PATHINFO_FILENAME);
                    })
                    ->transform(function ($item) use ($path) {
                        $filename = pathinfo($item, PATHINFO_FILENAME);
                        return "{$path[0]}\\{$path[1]}\\Faker\\{$filename}";
                    })
                    ->filter(function ($item) {
                        $object = new ReflectionClass($item);
                        return ($object->implementsInterface(ContentGenerationInterface::class));
                    })
                    ->sortBy(function ($item) {
                        $object = new ReflectionClass($item);
                        return $object->getStaticPropertyValue('sort');
                    });
            })
            ->filter()
            ->flatten();
    }
}