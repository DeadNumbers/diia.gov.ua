<?php namespace KitSoft\Pages\Extensions;

use Storage;
use KitSoft\Pages\Classes\StorageAdapter;
use League\Flysystem\Filesystem;

class StorageExtension
{
    /*
     * Construct
     */
    public function __construct()
    {
		Storage::extend('kitsoft-local', function($app, $config) {
            $adapter = new StorageAdapter($config['root']);
            return new Filesystem($adapter, $config);
        });
    }
}
