<?php namespace KitSoft\Core\Classes;

use ReflectionClass;
use Illuminate\Support\Collection;
use Model;
use System\Classes\PluginManager;

class PluginHelpers
{
    /**
     * getAllPlugins
     */
    public static function getAllPlugins(): Collection
    {
        return collect(PluginManager::instance()->getPlugins());
    }

    /**
     * getAllModels
     */
    public static function getAllModels(): Collection
    {
        return self::getAllPlugins()
            ->transform(function ($item, $key) {
                $path = explode('.', $key);
                $modelsPath = plugins_path(strtolower($path[0]) . "/" . strtolower($path[1]) . "/models");
                $files = glob("{$modelsPath}/*.php");

                return collect($files)
                    ->transform(function ($item) use ($path) {
                        $filename = pathinfo($item, PATHINFO_FILENAME);
                        return "{$path[0]}\\{$path[1]}\\Models\\{$filename}";
                    })
                    ->filter(function ($item) {
                        $object = new ReflectionClass($item);
                        return (!$object->isAbstract() && $object->isSubclassOf(Model::class));
                    });
            })
            ->merge(['Backend' => self::getModuleModels('Backend')])
            ->merge(['Cms' => self::getModuleModels('Cms')])
            ->merge(['System' => self::getModuleModels('System')]);
    }

    /**
     * getModuleModels
     */
    public static function getModuleModels(string $module): Collection
    {
        $files = glob(base_path("modules/{$module}/models/*.php"));

        return collect($files)
            ->transform(function ($item) use ($module) {
                $filename = pathinfo($item, PATHINFO_FILENAME);
                return "\\{$module}\\Models\\{$filename}";
            })
            // tmp fix for october build 1.0.458, need test in next build
            ->filter(function ($item) {
                return !in_array($item, ['\Cms\Models\ThemeExport', '\Cms\Models\ThemeImport']);
            })
            ->filter(function ($item) {
                $object = new ReflectionClass($item);
                return (!$object->isAbstract() && $object->isSubclassOf(Model::class));
            });
    }

    /**
     * getModelsExtendedWith
     */
    public static function getModelsExtendedWith(string $behavior): Collection
    {
        return self::getAllModels()
            ->transform(function ($items) use ($behavior) {
                return $items->filter(function ($item) use ($behavior) {
                    return $item::make()->isClassExtendedWith($behavior);
                });
            })->filter(function ($items) {
                return count($items);
            });
    }
}