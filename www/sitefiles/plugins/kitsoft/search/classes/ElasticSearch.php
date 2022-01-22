<?php namespace KitSoft\Search\Classes;

use KitSoft\Search\Classes\AbstractSearch;
use KitSoft\Search\Providers\Elastic\Provider;

class ElasticSearch extends AbstractSearch
{
    /**
     * getProviderObject
     */
    protected function getProviderObject(array $provider)
    {
        $customProvider = null;

        if (isset($provider['providers']) && array_key_exists('elastic', $provider['providers'])) {
            if (is_null($provider['providers']['elastic'])) {
                return;
            }

            $customProvider = $provider['providers']['elastic'];
        }

        $class = ($customProvider && class_exists($customProvider))
            ? $customProvider
            : Provider::class;

        return new $class($provider);
    }
}