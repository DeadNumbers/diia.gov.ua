<?php namespace KitSoft\Pages\Install\Items;

use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\Pages\Install\Helpers;
use KitSoft\Pages\Install\Items\AbstractInstaller;
use KitSoft\Pages\Interfaces\InstallerInterface;
use KitSoft\Pages\Models\Partial;

class PartialsInstaller extends AbstractInstaller implements InstallerInterface
{
    /**
     * install
     */
    public function install(): void
    {
        if (!isset($this->config['items'])) {
            return;
        }

        foreach ($this->config['items'] as $key => $row) {
            if (!isset($row['code']) || Partial::where('code', $row['code'])->first()) {
                continue;
            }

            if (isset($row['fields'])) {
                $row['fields'] = Helpers::prepareImages($row['fields']);
                $row['fields'] = json_encode($row['fields']);
            } else {
                $row['fields'] = null;
            }

            $data = Partial::make();
            $data->attributes = $row;
            $data->save();
        }
    }
}
