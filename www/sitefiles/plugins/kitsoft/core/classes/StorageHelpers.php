<?php namespace KitSoft\Core\Classes;

use Config;
use Exception;
use KitSoft\Core\Classes\Interfaces\StorageHelpersInterface;
use Mimey\MimeTypes;
use Model;
use October\Rain\Filesystem\Definitions;
use Storage;
use System\Models\File;
use ZipArchive;

class StorageHelpers implements StorageHelpersInterface
{
	public static $streamContext = [
		'ssl' => [
        	'verify_peer' => false,
        	'verify_peer_name' => false,
    	],
    	'http' => [
    		'timeout' => 10
    	]
    ];

	/**
     * attachFileToModel
     */
    public static function attachFileToModel(Model $model, string $url, string $field, $filename = null): bool
    {
        if (!$fileContents = @file_get_contents($url, false, stream_context_create(self::$streamContext))) {
            return false;
        }

        $file = new File();

        $model->{$field} = $file->fromData($fileContents, $filename ?? basename($url));

        if (method_exists($model, 'forceSave')) {
            $model->forceSave();
        } else {
            $model->save();
        }

        return true;
    }

	/**
	 * downloadFileToMedia
	 */
	public static function downloadFileToMedia($fileLink, $folder = null, $basename = false)
	{
		$fileLink = trim($fileLink);
		$fileLink = str_replace(' ', '%20', $fileLink);

        if (!$file = @file_get_contents($fileLink, false, stream_context_create(self::$streamContext))) {
        	trace_log("File not found [{$fileLink}]");
            return;
        }

        $fileExtension = self::getFileExtension($file);

        if (!in_array($fileExtension, Definitions::get('defaultExtensions'))) {
        	return;
        }

        $filename = ($basename)
        	? basename($fileLink)
        	: uniqid() . '.' . $fileExtension;

        return self::saveFile($file, $filename, $folder);
	}

	/**
	 * saveFile
	 */
	public static function saveFile($fileContent, $fileName, $folder = null)
	{
		setlocale(LC_ALL,'en_US.UTF-8');

		$storage = Config::get('cms.storage.media.folder');
		$filepath = "{$storage}/{$folder}/{$fileName}";

		$filepath = self::genUniqueFileName($filepath, $fileContent);

		Storage::makeDirectory("{$storage}/{$folder}");
        Storage::put($filepath, $fileContent);

        return Storage::url($filepath);
	}

	/**
	 * genUniqueFileName
	 */
	protected static function genUniqueFileName($filepath, $filecontent, $i = 0)
	{
		$oldFilepath = $filepath;

		if ($i >= 1) {
			$path_parts = pathinfo($filepath);
			$filepath = "{$path_parts['dirname']}/{$path_parts['filename']}-{$i}.{$path_parts['extension']}";
		}

		if (!Storage::exists($filepath)) {
			return $filepath;
		}

		if (md5(Storage::get($filepath)) == md5(stream_get_contents($filecontent))) {
			return $filepath;
		}

		return self::genUniqueFileName($oldFilepath, $filecontent, ++$i);
	}

	/**
	 * getFileExtension
	 */

	public static function getFileExtension($fileContents)
	{
		$finfo = finfo_open();
		$mime_type = finfo_buffer($finfo, $fileContents, FILEINFO_MIME_TYPE);
		finfo_close($finfo);

		$mimes = new MimeTypes();
		return $mimes->getExtension($mime_type);
	}

	/**
	 * getResourceExtension
	 */
	public static function getResourceExtension($resource): string
	{
		$mime = mime_content_type($resource);
		$mimes = new MimeTypes;
        return $mimes->getExtension($mime);
	}

	/**
     * unzip
     */
    public static function unzip(string $filepath): string
    {
        $zip = new ZipArchive();

        if (!$file = $zip->open($filepath)) {
            throw new Exception('File open error.');
        }
        
        $folder = storage_path('app/tmp/unzip_' . uniqid());
        $zip->extractTo($folder);

        return $folder . '/' . $zip->getNameIndex(0);
    }
}