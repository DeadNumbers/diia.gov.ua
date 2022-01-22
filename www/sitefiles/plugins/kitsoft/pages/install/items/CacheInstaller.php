<?php namespace KitSoft\Pages\Install\Items;

use KitSoft\Cacheroute\Models\CacheRoute;
use KitSoft\Pages\Install\Items\AbstractInstaller;
use KitSoft\Pages\Interfaces\InstallerInterface;
use System\Classes\PluginManager;

class CacheInstaller extends AbstractInstaller implements InstallerInterface
{
    /**
     * install
     */
    public function install(): void
    {
        if (!PluginManager::instance()->hasPlugin('KitSoft.Cacheroute')) {
            return;
        }

        if (!isset($this->config['items'])) {
            return;
        }

        foreach ($this->config['items'] as $row) {
            if (!isset($row['route_pattern']) || CacheRoute::where('route_pattern', $row['route_pattern'])->first()) {
                continue;
            }
            $data = CacheRoute::make();
            $data->attributes = $row;
            $data->save();
        }
    }
}
