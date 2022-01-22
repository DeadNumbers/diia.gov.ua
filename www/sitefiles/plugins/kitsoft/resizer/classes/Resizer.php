<?php namespace KitSoft\Resizer\Classes;

use KitSoft\Resizer\Models\Settings;
use October\Rain\Database\Attach\BrokenImage;
use October\Rain\Database\Attach\Resizer as BaseResizer;

class Resizer extends BaseResizer
{
	CONST WATERMARK_MARGE_RIGTH = 10;
	CONST WATERMARK_MARGE_BOTTOM = 10;

	/**
     * open
     */
    public static function open($file)
    {
        return new self($file);
    }

	/**
	 * getWatermark
	 */
	protected function getWatermark()
	{
		return Settings::instance()->watermark;
	}

	/**
	 * watermark
	 */
	public function watermark()
	{
		if (!$watermark = $this->getWatermark()) {
			return $this;
		}

		$watermark = self::open($watermark->getLocalPath())
            ->resize($this->getWidth() / 3, $this->getHeight() / 3);

        imagealphablending($this->image, true);

		imagecopy(
			$this->image,
			$watermark->image,
			imagesx($this->image) - imagesx($watermark->image) - self::WATERMARK_MARGE_RIGTH,
			imagesy($this->image) - imagesy($watermark->image) - self::WATERMARK_MARGE_BOTTOM,
			0,
			0,
			imagesx($watermark->image),
			imagesy($watermark->image)
		);

		imagedestroy($watermark->image);

        return $this;
	}

	/**
     * isNeedToResize
     */
    public function isNeedToResize($width, $height)
    {
        if ($width && $this->getWidth() >= $width) {
            return true;
        }

        if ($height && $this->getHeight() >= $height) {
            return true;
        }

        return false;
    }
}
