<?php namespace KitSoft\Pages\Install\Items;

use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\Pages\Install\Items\AbstractInstaller;
use KitSoft\Pages\Interfaces\InstallerInterface;
use KitSoft\Pages\Models\Menu;
use KitSoft\Pages\Models\MenuItem;
use KitSoft\Pages\Models\Page;
use KitSoft\Pages\Models\Partial;

class MenuInstaller extends AbstractInstaller implements InstallerInterface
{
    /**
     * install
     */
    public function install(): void
    {
        if (!isset($this->config['items'])) {
            return;
        }

        $pages = Page::isPublished()
            ->isNotSluggable()
            ->get();

        foreach ($this->config['items'] as $key => $row) {
            if (!$menu = $this->createMenu($row['attributes'])) {
                continue;
            }

            if (isset($row['importPages']) && $row['importPages']) {
                $pages->each(function ($page) use ($menu) {
                    $this->createMenuItem([
                        'title' => $page->title,
                        'menu_id' => $menu->id,
                        'type' => 'page',
                        'value' => $page->id
                    ]);
                });
            }

            if (isset($row['items'])) {
                $this->importMenuItems($row['items'], $menu);
            }
        }
    }

    /**
     * importMenuItems
     */
    protected function importMenuItems(array $items, Menu $menu, $parent_id = null): void {
        foreach ($items as $item) {
            $menuItem = $this->createMenuItem([
                'title' => $item['title'] ?? null,
                'menu_id' => $menu->id,
                'type' => $item['type'] ?? 'page',
                'parent_id' => $parent_id,
                'value' => $this->getValue($item['value'] ?? null),
                'value_link' => $item['value_link'] ?? null,
                'isHidden' => $item['isHidden'] ?? false,
                'isExternal' => $item['isExternal'] ?? false,
            ]);
            if (isset($item['items'])) {
                $this->importMenuItems($item['items'], $menu, $menuItem->id);
            }
        }
    }

    /**
     * createMenuItem
     */
    protected function createMenuItem($attributes)
    {
        $data = MenuItem::make();

        $data->attributes = $attributes;
        $data->save();

        return $data;
    }

    /**
     * createMenu
     */
    protected function createMenu($attributes)
    {
        if (!isset($attributes['code']) || Menu::where('code', $attributes['code'])->first()) {
            return;
        }

        $data = Menu::make();
        $data->attributes = $attributes;
        $data->save();

        return $data;
    }

    /**
     * getValue
     */
    protected function getValue($value)
    {
        if (!$value) {
            return;
        }
        
        if (substr($value, 0, 6) != 'slug::') {
            return $value;
        }

        $slug = substr($value, 6);
        
        return ($page = PagesHelper::getPageBySegments(explode('/', $slug)))
            ? $page->id
            : null;
    }
}
