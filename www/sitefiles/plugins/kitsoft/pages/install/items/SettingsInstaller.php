<?php namespace KitSoft\Pages\Install\Items;

use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\Pages\Install\Items\AbstractInstaller;
use KitSoft\Pages\Interfaces\InstallerInterface;

class SettingsInstaller extends AbstractInstaller implements InstallerInterface
{
    /**
     * install
     */
    public function install(): void
    {
        if (isset($this->config['items'])) {
            foreach ($this->config['items'] as $row) {
                if (!isset($row['model'])) {
                    throw new Exception('Model is not set in yaml file for settings item.');
                }
                if (!class_exists($row['model'])) {
                    throw new Exception('Class is not exist for settings item.' . $row['model']);
                }
                if (!isset($row['attributes'])) {
                    continue;
                }

                array_walk_recursive($row['attributes'], function (&$item) {
                    if (substr($item, 0, 6) == 'slug::') {
                        $item = PagesHelper::getPageBySegments(explode('/', substr($item, 6)))->id;
                    }
                });

                foreach ($row['attributes'] as $key => $attribute) {
                    $row['model']::set($key, $attribute);
                }
            }
        }
    }
}
