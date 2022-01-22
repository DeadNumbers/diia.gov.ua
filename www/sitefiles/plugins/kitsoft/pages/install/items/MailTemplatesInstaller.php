<?php namespace KitSoft\Pages\Install\Items;

use KitSoft\Pages\Install\Items\AbstractInstaller;
use KitSoft\Pages\Interfaces\InstallerInterface;
use System\Models\MailTemplate;

class MailTemplatesInstaller extends AbstractInstaller implements InstallerInterface
{
    /**
     * install
     */
    public function install(): void
    {
        if (!isset($this->config['items'])) {
            return;
        }

        foreach ($this->config['items'] as $row) {
            if (!isset($row['attributes']['code']) || MailTemplate::where('code', $row['attributes']['code'])->first()) {
                continue;
            }
            $data = MailTemplate::make();
            $data->attributes = $row['attributes'];
            $data->save();
        }
    }
}
