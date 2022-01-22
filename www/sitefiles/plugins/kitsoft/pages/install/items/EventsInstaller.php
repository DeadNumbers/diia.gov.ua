<?php namespace KitSoft\Pages\Install\Items;

use KitSoft\Events\Models\Category;
use KitSoft\Events\Models\Event;
use KitSoft\Pages\Install\Helpers;
use KitSoft\Pages\Install\Items\AbstractInstaller;
use KitSoft\Pages\Interfaces\InstallerInterface;
use System\Classes\PluginManager;

class EventsInstaller extends AbstractInstaller implements InstallerInterface
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
            $this->importEvents($this->config['items']);
        }
    }

    /**
     * importEvents
     */
    protected function importEvents(array $items): void
    {
        foreach ($items as $key => $row) {
            if (!isset($row['slug']) || Event::where('slug', $row['slug'])->first()) {
                continue;
            }

            $data = Event::make();
            $data->attributes = $row;
            $data = $this->prepareData($data);
            $data->forceSave();
        }
    }

    /**
     * prepareData
     */
    protected function prepareData(Event $data): Event
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

        if (isset($data->attributes['dt_from'])) {
            $data->attributes['dt_from'] = $this->prepareDate($data->attributes['dt_from']);
        }
        if (isset($data->attributes['dt_to'])) {
            $data->attributes['dt_to'] = $this->prepareDate($data->attributes['dt_to']);
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

    /**
     * prepareDate
     */
    protected function prepareDate(string $date): string
    {
        switch ($date) {
            case 'current':
                $date = date('Y-m-d H:i:s');
                break;
            case '+1day':
                $date = date('Y-m-d H:i:s', strtotime('+1 day'));
                break;
            case '+1week':
                $date = date('Y-m-d H:i:s', strtotime('+1 week'));
                break;
            case '+1month':
                $date = date('Y-m-d H:i:s', strtotime('+1 month'));
                break;
        }

        return $date;
    }
}
