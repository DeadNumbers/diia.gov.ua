<?php namespace KitSoft\Pages\Install\Items;

use KitSoft\Pages\Install\Items\AbstractInstaller;
use KitSoft\Pages\Interfaces\InstallerInterface;
use Kitsoft\Core\Models\GoogleAnalytics;

class GoogleAnalyticsInstaller extends AbstractInstaller implements InstallerInterface
{
    /**
     * install
     */
    public function install(): void
    {
        if (!isset($this->config['code'])) {
            return;
        }

        $settings = GoogleAnalytics::instance();
        $settings->code = $this->config['code'];
        $settings->save();
    }
}
