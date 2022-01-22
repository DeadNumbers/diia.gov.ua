<?php

namespace KitSoft\Pages\Classes;

use Str;
use Crypt;
use Backend;
use Cms\Classes\Page as CmsPage;
use Cms\Classes\Theme;
use Config;
use KitSoft\Core\Twig\UrlFilter;
use KitSoft\Pages\Models\Page;
use KitSoft\Pages\Models\Settings;
use KitSoft\Pages\Twig\Filters as PageFilters;
use October\Rain\Parse\Yaml;

class PagesHelper
{
    /**
     * getPageBySegments, recursion
     */
    public static function getPageBySegments($segments, $i = 0, $parent_id = null)
    {
        $slug = empty($segments[$i])
            ? '/'
            : $segments[$i];

        if (!$page = self::getSluggablePage($slug, $parent_id)) {
            return false;
        }

        return (++$i == count($segments))
            ? $page
            : self::getPageBySegments($segments, $i, $page->id);
    }

    /**
     * getSluggablePage
     */
    protected static function getSluggablePage($slug, $parent_id)
    {
        $page = Page::isPublishedOrPreview()
            ->where('slug', $slug)
            ->where('parent_id', $parent_id)
            ->first();

        return $page ?: Page::isPublishedOrPreview()
            ->where('sluggable', 1)
            ->whereNotNull('parent_id')
            ->where('parent_id', $parent_id)
            ->first();
    }

    /**
     * url
     */
    public static function url($page, $params, $routingByPages = false)
    {
        $routingByPages = $routingByPages ?: Config::get('kitsoft.pages::routingByPages');

        $url = ($routingByPages)
            ? PageFilters::pageLink($page, $params)
            : CmsPage::url($page, $params);

        return UrlFilter::url($url);
    }

    /**
     * getModelEditUrl
     */
    public static function getModelEditUrl(string $hash): string
    {
        $data = Crypt::decrypt($hash);

        if (!isset($data['model'], $data['id'], $data['attributes'])) {
            return '#';
        }

        $segments = explode('\\', $data['model']);

        if (count($segments) !== 4) {
            return '#';
        }

        $url = sprintf('%s/%s/%s/update/%d',
            $segments[0],
            $segments[1],
            Str::plural($segments[3]),
            $data['id']
        );

        $url = strtolower($url . '?' . http_build_query($data['attributes']));

        return Backend::url($url);
    }

    /**
     * getRoutingPagesOptions
     */
    public static function getRoutingPagesOptions()
    {
        if (Config::get('kitsoft.pages::routingByPages')) {
            return Page::orderBy('nest_left')
                ->get()
                ->listsNested('title', 'id');
        } else {
            return CmsPage::all()
                ->mapWithKeys(function ($item, $key) {
                    return [$item->baseFileName => "{$item->title} ({$item->url})"];
                });
        }
    }

    /**
     * getPageSettings
     */
    public static function getPageSettings(string $layout): CmsPage
    {
        $page = CmsPage::find($layout);

        return $page ?? new CmsPage();
    }

    /**
     * getUrlByModel
     */
    public static function getUrlByModel(string $model, array $slug)
    {
        if (!$routerPageId = Settings::get("routes.{$model}")) {
            return;
        }

        return self::url($routerPageId, $slug);
    }

    /**
     * getSectionConfig
     */
    public static function getSectionConfig($code)
    {
        $theme = Theme::getActiveThemeCode();
        $config = themes_path("{$theme}/fields/sections/{$code}.yaml");

        if (!file_exists($config)) {
            return;
        }

        $yaml = new Yaml();

        return $yaml->parsefile($config);
    }

    /**
     * getComponentConfig
     */
    public static function getComponentConfig($class, $code): array
    {
        $class = explode('\\', strtolower($class));
        $componentSubPath = "{$class[0]}/{$class[1]}/{$code}.yaml";
        $theme = Theme::getActiveThemeCode();
        $config = themes_path("{$theme}/fields/components/{$componentSubPath}");

        if (!file_exists($config)) {
            return [];
        }

        $yaml = new Yaml();

        return $yaml->parsefile($config);
    }

    /**
     * getPartialConfig
     */
    public static function getPartialConfig($code)
    {
        $theme = Theme::getActiveThemeCode();
        $config = themes_path("{$theme}/fields/partials/{$code}.yaml");

        if (!file_exists($config)) {
            return;
        }

        $yaml = new Yaml();

        return $yaml->parsefile($config);
    }

    /**
     * getPageConfig
     */
    public static function getPageConfig($template)
    {
        $theme = Theme::getActiveThemeCode();
        $config = themes_path("{$theme}/fields/pages/{$template}.yaml");

        if (!file_exists($config)) {
            return;
        }

        $yaml = new Yaml();

        return $yaml->parsefile($config);
    }

    /**
     * getConfigFieldsFromTabs
     */
    public static function getConfigFieldsFromTabs(array $config)
    {
        return array_merge(
            $config['fields'] ?? [],
            $config['tabs']['fields'] ?? [],
            $config['secondaryTabs']['fields'] ?? []
        );
    }

    /**
     * getComponentsConfigByLayout
     */
    public static function getComponentsConfigByLayout(string $template = null)
    {
        $config = Theme::getActiveTheme()->getConfig();

        return array_get($config, "components.{$template}");
    }
}
