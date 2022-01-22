<?php namespace KitSoft\Search\Classes;

use App;
use Config;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\Search\Classes\ElasticResponseHandler;
use KitSoft\Search\Models\ProvidersSettings;
use KitSoft\Search\Models\Settings;
use Model;
use System\Classes\PluginManager;

class Helpers
{
    /**
     * search
     */
    public static function search(string $type, array $params = [])
    {
        $client = App::make('KitSoft\Search\Classes\Interfaces\ElasticClientContract');

        $response = $client->searchTemplate([
            'index' => self::getElasticIndex($type),
            'body' => [
                'id' => self::getElasticTemplate($type),
                'params' => $params
            ],
            'client' => [
                'timeout' => 5,
                'connect_timeout' => 5
            ]
        ]);

        return new ElasticResponseHandler($response);
    }

    /**
     * getProviders
     */
    public static function getProviders()
    {
        $config = Config::get('kitsoft.search::providers');

        foreach($config as $key => &$provider) {
            $provider['alias'] = $key;

            if (!isset($provider['mappings'])) {
                continue;
            }

            foreach ($provider['mappings'] as &$field) {
                if (!isset($field['analyzer'])) {
                    continue;
                }
                $field['analyzer'] = Settings::get('elastic_analyzer') ?? $field['analyzer'];
            } 
        }

        if (is_array($disabledProvides = ProvidersSettings::get('disabled_providers'))) {
            $config = array_diff_key($config, array_flip($disabledProvides));
        }

        return $config;
    }

    /**
     * getProvidersCollection
     */
    public static function getProvidersCollection()
    {
        return collect(self::getProviders());
    }

    /**
     * getElasticIndexes
     */
    public static function getElasticIndexes()
    {
        return self::getProvidersCollection()->mapWithKeys(function ($item, $key) {
            return [$key => Settings::get("{$key}_index")];
        });
    }

    /**
     * getElasticTemplates
     */
    public static function getElasticTemplates()
    {
        return self::getProvidersCollection()->mapWithKeys(function ($item, $key) {
            return [$key => Settings::get("{$key}_template")];
        });
    }

    /**
     * getElasticIndex
     */
    public static function getElasticIndex(string $type)
    {
        $provider = self::getProvidersCollection()->get($type);

        if (isset($provider['index'])) {
            $index = $provider['index'];

            if (PluginManager::instance()->hasPlugin('KitSoft.MultiLanguage')) {
                $index = sprintf($index, MultiLanguage::instance()->getActiveLocale());
            }

            return $index;
        }

        return self::getElasticIndexes()->get($type);
    }

    /**
     * getElasticTemplate
     */
    public static function getElasticTemplate(string $type)
    {
        $provider = self::getProvidersCollection()->get($type);

        if (isset($provider['template'])) {
            return $provider['template'];
        }

        return self::getElasticTemplates()->get($type);
    }

    /**
     * attachModelFiles
     */
    public static function attachModelFiles(Model $model, array $files)
    {
        foreach ($files as $row) {
            if (!$file = $model->{$row}) {
                continue;
            }

            $result[$row] = [
                'file_name' => $file->file_name,
                'url' => $file->path,
                'extension' => $file->extension,
                'size' => $file->sizeToString()
            ];
        }

        return $result ?? [];
    }
}
