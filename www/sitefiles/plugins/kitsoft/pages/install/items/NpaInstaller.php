<?php namespace KitSoft\Pages\Install\Items;

use KitSoft\NPA\Models\Act;
use KitSoft\NPA\Models\Category;
use KitSoft\Pages\Install\Items\AbstractInstaller;
use KitSoft\Pages\Interfaces\InstallerInterface;
use System\Classes\PluginManager;

class NpaInstaller extends AbstractInstaller implements InstallerInterface
{
    /**
     * install
     */
    public function install(): void
    {
        if (!PluginManager::instance()->hasPlugin('KitSoft.NPA')) {
            return;
        }

        if (isset($this->config['categories'])) {
            $this->importCategories($this->config['categories']);
        }

        if (isset($this->config['items'])) {
            $this->importActs($this->config['items']);
        }
    }

    /**
     * importActs
     */
    protected function importActs(array $items): void
    {
        foreach ($items as $key => $row) {
            if (!isset($row['slug']) || Act::where('slug', $row['slug'])->first()) {
                continue;
            }

            $data = Act::make();
            $data->attributes = $row;
            $data = $this->prepareData($data);
            $data->forceSave();
        }
    }

    /**
     * importCategories
     */
    protected function importCategories(array $items): void
    {
        foreach ($items as $key => $row) {
            if (!isset($row['name']) || Category::where('name', $row['name'])->first()) {
                continue;
            }
            
            $data = Category::make();
            $data->attributes = $row;
            $data->forceSave();
        }
    }

    /**
     * prepareData
     */
    protected function prepareData(Act $data): Act
    {
        // category
        if (isset($data->attributes['category'])) {
            if ($category = Category::where('name', $data->attributes['category'])->first()) {
                $data->category = $category->id;
            }
            unset($data->attributes['category']);
        }

        return $data;
    }
}
