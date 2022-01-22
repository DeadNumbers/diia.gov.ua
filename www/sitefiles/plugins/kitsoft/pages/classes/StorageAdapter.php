<?php namespace KitSoft\Pages\Classes;

use Response;
use ApplicationException;
use League\Flysystem\Config;
use League\Flysystem\Adapter\Local;

class StorageAdapter extends Local
{
	protected $fileExistMessage = "Файл [%s] вже існує, будь ласка, перейменуйте та завантажте ще раз.";

	/**
     * @inheritdoc
     */
    public function write($path, $contents, Config $config)
    {
    	$path = $this->prepareFilename($path);

    	$this->checkFileExist($path);

    	return parent::write($path, $contents, $config);
    }

	/**
     * @inheritdoc
     */
    public function update($path, $contents, Config $config)
    {
    	$path = $this->prepareFilename($path);
    	
        $this->checkFileExist($path);

        return parent::update($path, $contents, $config);
    }

    /**
     * checkFileExist
     */
    protected function checkFileExist(string $path)
    {
    	if (!$this->has($path)) {
    		return;
    	}

    	$message = sprintf($this->fileExistMessage, basename($path));

    	// tmp hack, because october has bug with response status code
        if (request()->headers->has('x-october-fileupload')) {
        	die(Response::make($message, 400)->send());
        }

    	throw new ApplicationException($message);
    }

    /**
     * prepareFilename
     */
    protected function prepareFilename(string $path)
    {
    	$fileName = pathinfo($path, PATHINFO_FILENAME);
    	$extension = pathinfo($path, PATHINFO_EXTENSION);
    	$dirName = pathinfo($path, PATHINFO_DIRNAME);

    	$fileName = str_slug($fileName, '-');

		return $dirName . '/' . $fileName . '.' . $extension;
    }
}