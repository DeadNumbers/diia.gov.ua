<?php namespace KitSoft\Pages\Install\Items;

use Config;
use Storage;
use KitSoft\MediaGallery\Models\MediaGallery;
use KitSoft\Pages\Install\Helpers;
use KitSoft\Pages\Install\Items\AbstractInstaller;
use KitSoft\Pages\Interfaces\InstallerInterface;
use System\Classes\PluginManager;
use Cms\Classes\Theme;
use System\Models\File;

class GalleriesInstaller extends AbstractInstaller implements InstallerInterface
{
    /**
     * install
     */
    public function install(): void
    {
        if (!PluginManager::instance()->hasPlugin('KitSoft.MediaGallery')) {
            return;
        }

        if (isset($this->config['items'])) {
            $this->importGalleries($this->config['items']);
        }
    }

    /**
     * importGalleries
     */
    protected function importGalleries(array $items): void
    {
        foreach ($items as $key => $row) {
            $attributes = &$row['attributes'];
            if (!isset($attributes['slug']) || MediaGallery::where('slug', $attributes['slug'])->first()) {
                continue;
            }

            $data = MediaGallery::make();
            $data->attributes = $attributes;
            $data->forceSave();

            if (isset($row['featured_images'])) {
                $this->pushGalleriesImages($row['featured_images'], $data);
            }
        }
    }

    /**
     * pushGalleriesImages
     */
    protected function pushGalleriesImages(array $items, MediaGallery $model): void {
        $activeTheme = Theme::getActiveThemeCode();
        $storage = Config::get('cms.storage.media.path');

        foreach($items as $path) {
            $filepath = themes_path("{$activeTheme}{$path}");
            $filename = pathinfo($path, PATHINFO_BASENAME);

            copy($filepath, base_path("{$storage}/{$filename}"));

            $systemFile = new File;
            $systemFile->disk_name = $systemFile->file_name = "/{$filename}";
            $systemFile->field = 'featured_images';
            $systemFile->attachment_id = $model->id;
            $systemFile->attachment_type = get_class($model);
            $systemFile->is_public = 1;
            $systemFile->file_size = filesize($filepath);
            $systemFile->content_type = mime_content_type($filepath);
            $systemFile->created_at = date('Y-m-d H:i:s');
            $systemFile->save();            
        }
    }
}
