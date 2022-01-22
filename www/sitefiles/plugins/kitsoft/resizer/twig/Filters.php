<?php namespace KitSoft\Resizer\Twig;

use KitSoft\Resizer\Classes\Image;

/**
 * Filters
 */
class Filters
{
	/**
	 * resize
	 */
	public static function resize($file_path, $width = false, $height = false, $watermark = false)
	{
		return self::modifyImage($file_path, $width, $height, $watermark);
	}

	/**
	 * watermark
	 */
	public static function watermark($file_path)
	{
		return self::modifyImage($file_path, null, null, true);
	}

	/**
	 * modifyImage
	 */
	protected static function modifyImage($file_path, $width = false, $height = false, $watermark = false)
	{
		$extension = pathinfo($file_path, PATHINFO_EXTENSION);

		if (in_array($extension, ['svg'])) {
			return $file_path;
		}

		$image = new Image($file_path);
        
        return $image->resize($width, $height, $watermark);
	}
}
