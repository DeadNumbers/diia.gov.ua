<?php namespace KitSoft\Pages\Install\Items;

use KitSoft\Pages\Install\Helpers;
use KitSoft\Pages\Install\Items\AbstractInstaller;
use KitSoft\Pages\Interfaces\InstallerInterface;
use KitSoft\Persons\Models\Group;
use KitSoft\Persons\Models\Person;
use System\Classes\PluginManager;

class PersonsInstaller extends AbstractInstaller implements InstallerInterface
{
    /**
     * install
     */
    public function install(): void
    {
        if (!PluginManager::instance()->hasPlugin('KitSoft.Persons')) {
            return;
        }

        if (isset($this->config['groups'])) {
            self::importGroups($this->config['groups']);
        }

        if (isset($this->config['items'])) {
            self::importPersons($this->config['items']);
        }
    }

    /**
     * importPersons
     */
    protected function importPersons(array $items): void
    {
        foreach ($items as $key => $row) {
            if (!isset($row['slug']) || Person::where('slug', $row['slug'])->first()) {
                continue;
            }

            $row['attributes']['slug'] = $row['slug'];
            $group = Group::where('name', $row['group'])->first();

            $data = Person::make();
            $data->attributes = $row['attributes'];
            $data->groups = $group ? [$group->id] : [];

            // avatar
            if(isset($row['avatar'])) {
                $data->avatar = Helpers::prepareFeaturedImage($row['avatar']);
            }
            
            $data->forceSave();
        }
    }

    /**
     * importGroups
     */
    protected function importGroups(array $items): void
    {
        foreach ($items as $key => $row) {
            if (!isset($row['name']) || Group::where('name', $row['name'])->first()) {
                continue;
            }
            
            $data = Group::make();
            $data->attributes = $row;
            $data->save();
        }
    }
}
