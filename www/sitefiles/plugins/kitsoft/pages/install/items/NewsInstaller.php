<?php namespace KitSoft\Pages\Install\Items;

use KitSoft\Pages\Install\Helpers;
use KitSoft\Pages\Install\Items\AbstractInstaller;
use KitSoft\Pages\Interfaces\InstallerInterface;
use RainLab\Blog\Models\Category;
use RainLab\Blog\Models\Post;
use System\Classes\PluginManager;

class NewsInstaller extends AbstractInstaller implements InstallerInterface
{
    /**
     * install
     */
    public function install(): void
    {
        if (!PluginManager::instance()->hasPlugin('RainLab.Blog')) {
            return;
        }

        if (isset($this->config['categories'])) {
            $this->importCategories($this->config['categories']);
        }

        if (isset($this->config['items'])) {
            $this->importNews($this->config['items']);
        }
    }

    /**
     * importNews
     */
    protected function importNews(array $items): void
    {
        foreach ($items as $key => $row) {
            if (!isset($row['slug']) || Post::where('slug', $row['slug'])->first()) {
                continue;
            }

            $data = Post::make();
            $data->attributes = $row;
            $data = $this->prepareData($data);
            $data->forceSave();
        }
    }

    /**
     * prepareData
     */
    protected function prepareData(Post $data): Post
    {
        // featured_images
        $data = $this->prepareDataFeaturedImages($data);

        // category
        if (isset($data->attributes['category'])) {
            $category = Category::where('slug', $data->attributes['category'])->first();
            $data->categories = $category
                ? [$category->id]
                : null;
            unset($data->attributes['category']);
        }

        return $data;
    }

    /**
     * importCategories
     */
    protected function importCategories(array $items): void
    {
        foreach ($items as $key => $row) {
            if (!isset($row['slug']) || Category::where('slug', $row['slug'])->first()) {
                continue;
            }
            $data = Category::make();
            $data->attributes = $row;
            $data->save();
        }
    }
}
