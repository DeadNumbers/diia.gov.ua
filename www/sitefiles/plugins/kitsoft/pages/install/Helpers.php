<?php namespace KitSoft\Pages\Install;

use Cms\Classes\Theme;
use Config;
use Event;
use Exception;
use Model;
use October\Rain\Parse\Yaml;
use October\Rain\Support\Collection;
use Storage;
use System\Models\File;

class Helpers
{
    /**
     * getConfigDirectory
     */
    public static function getConfigDirectory(): string
    {
        $activeTheme = Theme::getActiveThemeCode();
        $themeDirectory = themes_path($activeTheme);

        $installerDirectory = "{$themeDirectory}/install";

        Event::fire('kitsoft.pages::install.helpers.getConfigDirectory', [&$installerDirectory]);

        return $installerDirectory;
    }

    /**
     * getConfig
     */
    public static function getConfig(): Collection
    {
        $yaml = new Yaml();
        $configDir = self::getConfigDirectory();
        $filepath = "{$configDir}/%s.yaml";

        return self::getConfigFiles()
            ->filter(function ($item) use ($filepath) {
                return file_exists(sprintf($filepath, $item));
            })
            ->mapWithKeys(function ($item) use ($yaml, $filepath) {
                return [$item => $yaml->parsefile(sprintf($filepath, $item))];
            })
            ->filter(function ($item) {
                return $item;
            })
            ->sortBy('step');
    }

    /**
     * getConfigFiles
     */
    public static function getConfigFiles(): Collection
    {
        $configDir = self::getConfigDirectory();
        $files = scandir($configDir);

        return collect($files)
            ->filter(function ($item) {
                return (pathinfo($item, PATHINFO_EXTENSION) == 'yaml');
            })
            ->transform(function ($item) {
                return pathinfo($item, PATHINFO_FILENAME);
            });
    }

    /**
     * prepareFeaturedImage
     */
    public static function prepareFeaturedImage(string $path): File
    {
        $image = self::prepareFeaturedImages([$path]);

        return reset($image);
    }

    /**
     * prepareFeaturedImages
     */
    public static function prepareFeaturedImages(array $items): array
    {
        $activeTheme = Theme::getActiveThemeCode();

        foreach ($items as &$path) {
            $image = themes_path("{$activeTheme}{$path}");
            $filename = pathinfo($image, PATHINFO_BASENAME);
            $path = (new File)->fromData(file_get_contents($image), $filename);
        }

        return $items;
    }

    /**
     * prepareImages
     */
    public static function prepareImages(array $items): array
    {
        array_walk_recursive($items, function (&$item, $key) {
            if ($key == 'image' && isset($item)) {
                $item = self::copyImage($item);
            }
        });

        return $items;
    }

    /**
     * copyImage
     */
    public static function copyImage(string $path): string
    {
        if (substr($path, 0, 13) != 'mediafinder::') {
            return $path;
        }

        $theme = Theme::getActiveThemeCode();
        $storage = Config::get('cms.storage.media.folder');
        $filepath = themes_path("{$theme}" . substr($path, 13));
        $filename = pathinfo($filepath, PATHINFO_BASENAME);

        Storage::makeDirectory($storage);
        Storage::put("{$storage}/{$filename}", file_get_contents($filepath));

        return "/{$filename}";
    }
}
