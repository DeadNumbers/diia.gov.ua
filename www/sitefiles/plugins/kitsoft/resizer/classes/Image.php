<?php namespace KitSoft\Resizer\Classes;

use Exception;
use File as FileHelper;
use October\Rain\Database\Attach\BrokenImage;
use October\Rain\Database\Attach\File;
use KitSoft\Resizer\Classes\Resizer;

class Image
{
    protected $filePath;
    protected $settings;
    protected $file;
    protected $thumbFilename;
    protected $thumbDir;
    protected $thumbFilepath;
    protected $storageDir = '/storage/app/thumbnails';
    protected $options = [
        'mode' => 'auto',
        'offset' => [0, 0],
        'quality' => 95,
        'sharpen' => 0,
        'compress' => true
    ];

    public function __construct($filePath = false)
    {
        $this->file = new File;

        if ($filePath instanceof File) {
            $this->filePath = $filePath->getLocalPath();
            return;
        }
        
        $filePath = rawurldecode($filePath);
        
        $this->filePath = (file_exists($filePath))
            ? $filePath
            : $this->parseFileName($filePath);
    }

    /**
     * resize
     */
    public function resize($width = false, $height = false, bool $watermark = false)
    {
        if (!is_file($this->filePath)) {
            return false;
        }
        
        $this->thumbFilename = $this->getThumbFilename($width, $height);
        $this->thumbDir = $this->getThumbDir();
        $this->thumbFilepath = $this->getThumbFilepath();

        if (!$this->isThumbExist()) {
            try {
                if (!file_exists($this->thumbDir)) {
                    mkdir($this->thumbDir, 0755, true);
                }

                $resizer = Resizer::open($this->filePath);

                // resize
                if ($resizer->isNeedToResize($width, $height)) {
                    $resizer = $resizer->resize($width, $height, $this->options);
                }

                // watermark
                if ($watermark) {
                    $resizer = $resizer->watermark();
                }

                // save new image
                $resizer->save($this->thumbFilepath);
            } catch (Exception $ex) {
                BrokenImage::copyTo($this->thumbFilepath);
            }
        }

        return $this;
    }

    /**
     * getThumbFilename
     */
    protected function getThumbFilename($width = null, $height = null)
    {
        $pathinfo =  pathinfo($this->filePath);

        if (!isset($width, $height)) {
            return $pathinfo['filename'] . '.' . $pathinfo['extension'];
        }

        return $pathinfo['filename']  . '_' . (int)$width . 'x' . (int)$height . '.' . $pathinfo['extension'];
    }

    /**
     * getThumbDir
     */
    protected function getThumbDir()
    {
        return base_path($this->getThumbAppDir());
    }

    /**
     * getThumbFilepath
     */
    protected function getThumbFilepath()
    {
        return $this->thumbDir . $this->thumbFilename;
    }

    /**
     * getThumbAppDir
     */
    protected function getThumbAppDir()
    {
        $disk_name = md5($this->filePath);
        return $this->storageDir . '/' . implode('/', array_slice(str_split($disk_name, 3), 0, 3)) . '/';
    }

    /**
     * isThumbExist
     */
    protected function isThumbExist()
    {
        return is_file($this->getThumbFilepath());
    }

    /**
     * getThumbImageUrl
     */
    public function getThumbImageUrl()
    {
        return $this->getThumbAppDir() . $this->thumbFilename;
    }

    /**
     * parseFileName get path from url
     */
    protected function parseFileName($filePath)
    {
        $path = parse_url($filePath, PHP_URL_PATH);
        $folders = [
            config('cms.themesPath'),
            config('cms.pluginsPath'),
            config('cms.storage.uploads.path'),
            config('cms.storage.media.path')
        ];

        foreach ($folders as $folder) {
            if (str_contains($path, $folder)) {
                $paths = explode($folder, $path, 2);
                return base_path($folder . end($paths));
            }
        }

        return base_path($path);
    }

    /**
     * render
     */
    public function render()
    {
        return '<img src="' . $this . '" />';
    }

    /**
     * __toString
     */
    public function __toString()
    {
        return $this->getThumbImageUrl();
    }
}
