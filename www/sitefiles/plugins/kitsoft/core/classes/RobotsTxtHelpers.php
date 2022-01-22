<?php namespace KitSoft\Core\Classes;

use Cache;
use KitSoft\Core\Classes\Interfaces\RobotsTxtInterface;
use KitSoft\Core\Classes\MultiSiteHelpers;
use KitSoft\MultiSite\Classes\MultiSite;
use Kitsoft\Core\Models\RobotsTxt;
use System\Classes\PluginManager;

class RobotsTxtHelpers implements RobotsTxtInterface
{
    /**
     * getCacheKey
     */
    public static function getCacheKey(): string
    {
        $key = 'robots_txt';

        if ($site = MultiSiteHelpers::site()) {
            $key .= "[site-{$site->id}]";
        }

        return $key;
    }

    /**
     * getRobotsContent
     */
    public static function getRobotsContent(): string
    {
        $cacheKey = self::getCacheKey();

        if (!$data = Cache::get($cacheKey)) {
            $data = RobotsTxt::instance()->attributes;
            Cache::forever($cacheKey, $data);
        }

        return (!isset($data['status']) || !$data['status'])
            ? "User-agent: *\r\nDisallow: /"
            : $data['code'];
    }

    /**
     * enableIndex
     */
    public static function enableIndex(bool $force = false): RobotsTxt
    {
        $robotsTxt = RobotsTxt::instance();

        if ($force || !$robotsTxt->status) {
            $robotsTxt->status = 1;
            $robotsTxt->code = "User-agent: *\r\nDisallow:";
            $robotsTxt->save();
        }

        return $robotsTxt;
    }
}
