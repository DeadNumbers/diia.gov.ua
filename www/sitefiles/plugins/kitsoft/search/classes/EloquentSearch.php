<?php namespace KitSoft\Search\Classes;

use KitSoft\Search\Classes\AbstractSearch;
use KitSoft\Search\Providers\Eloquent\Provider;

class EloquentSearch extends AbstractSearch
{
    /**
     * getProviderObject
     */
    protected function getProviderObject(array $provider)
    {
        $customProvider = null;

        if (isset($provider['providers']) && array_key_exists('eloquent', $provider['providers'])) {
            if (is_null($provider['providers']['eloquent'])) {
                return;
            }

            $customProvider = $provider['providers']['eloquent'];
        }

        $class = ($customProvider && class_exists($customProvider))
            ? $customProvider
            : Provider::class;

        return new $class($provider);
    }
}
