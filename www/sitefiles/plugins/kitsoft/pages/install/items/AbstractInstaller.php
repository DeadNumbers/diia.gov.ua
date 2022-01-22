<?php namespace KitSoft\Pages\Install\Items;

use Model;
use KitSoft\Pages\Install\Helpers;

abstract class AbstractInstaller
{
    protected $config;

    /**
     * __construct
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * prepareData
     */
    protected function prepareDataFeaturedImages(Model $data): Model
    {
        // featured_images
        if (isset($data->attributes['featured_images'])) {
            $featured_images = Helpers::prepareFeaturedImages($data->attributes['featured_images']);
            foreach ($featured_images as $image) {
                $data->featured_images = $image;
            }
            unset($data->attributes['featured_images']);
        }

        return $data;
    }
}
