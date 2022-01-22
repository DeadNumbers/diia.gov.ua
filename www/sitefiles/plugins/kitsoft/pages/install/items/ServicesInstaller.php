<?php namespace KitSoft\Pages\Install\Items;

use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\Pages\Install\Helpers;
use KitSoft\Pages\Install\Items\AbstractInstaller;
use KitSoft\Pages\Interfaces\InstallerInterface;
use KitSoft\Services\Models\MainCategory;
use KitSoft\Services\Models\Service;
use KitSoft\Services\Models\SubCategory;
use KitSoft\Timeline\Models\Settings as TimelineSettings;
use System\Classes\PluginManager;

class ServicesInstaller extends AbstractInstaller implements InstallerInterface
{
    /**
     * install
     */
    public function install(): void
    {
        if (!PluginManager::instance()->hasPlugin('KitSoft.Services')) {
            return;
        }

        if (isset($this->config['mainCategories'])) {
            $this->importMainCategories($this->config['mainCategories']);
        }

        if (isset($this->config['categories'])) {
            $this->importCategories($this->config['categories']);
        }

        if (isset($this->config['items'])) {
            $this->importServices($this->config['items']);
        }
    }

    /**
     * importMainCategories
     */
    protected function importMainCategories(array $items): void
    {
        foreach ($items as $key => $row) {
            if (!isset($row['name']) || MainCategory::where('name', $row['name'])->first()) {
                continue;
            }
            $data = MainCategory::make();
            $data->attributes = $row;
            $data->save();
        }
    }

    /**
     * importCategories
     */
    protected function importCategories(array $items): void
    {
        foreach ($items as $key => $row) {
            if (!isset($row['name']) || SubCategory::where('name', $row['name'])->first()) {
                continue;
            }
            $data = SubCategory::make();
            $data->attributes = $row;
            $data = $this->prepareCategoryData($data);
            $data->save();
        }
    }

    /**
     * importServices
     */
    protected function importServices(array $items): void
    {
        foreach ($items as $key => $row) {
            $attr = &$row['attributes'];
            if (!isset($attr['slug']) || Service::where('slug', $attr['slug'])->first()) {
                continue;
            }

            $data = Service::make();
            $data->attributes = $attr;
            $data->forceSave();

            $this->pushServiceCategories($data, $row['categories'] ?? []);
        }
    }

    /**
     * prepareCategoryData
     */
    protected function prepareCategoryData(SubCategory $data): SubCategory
    {
        // category
        if (isset($data->attributes['category'])) {
            $category = MainCategory::where('name', $data->attributes['category'])->first();
            $data->category = $category
                ? $category->id
                : null;
            unset($data->attributes['category']);
        }

        $data->attributes = Helpers::prepareImages($data->attributes);

        return $data;
    }

    /**
     * pushServiceCategories
     */
    protected function pushServiceCategories(Service $service, array $categories): Service
    {
        foreach ($categories as &$row) {
            if (!$category = SubCategory::where('name', $row)->first()) {
                continue;
            }
            $row = $category->id;
        }

        $service->subcategories = $categories;
        $service->forceSave();

        // set pivots
        foreach($service->subcategories as $category) {
            $service->subcategories()->updateExistingPivot($category->id, ['is_top' => true]);
        }

        return $service;
    }
}
