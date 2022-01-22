<?php namespace KitSoft\Core\Classes;

use App;
use Model;
use Config;
use BackendAuth;
use KitSoft\Core\Twig\UrlFilter;
use KitSoft\Pages\Models\Page;
use Cms\Classes\Page as CmsPage;

class BackendPreview
{
    static $previewParam = 'v';

    /**
     * link
     */
    public static function link(Model $model, $component) {
        $link = self::getLinkByRoute($model, $component);

        return UrlFilter::url($link) . '?' . self::$previewParam . '=' . uniqid();
    }

    /**
     * isValidPreview
     */
    public static function isValidPreview()
    {
        if (!BackendAuth::check()) {
            return false;
        }

        if (App::runningInBackend()) {
            return true;
        }

        return request()->has(self::$previewParam);
    }

    /**
     * getLinkByRoute
     */
    protected static function getLinkByRoute(Model $model, $component) {
        if (get_class($model) == 'KitSoft\Pages\Models\Page') {
            return $model->url;
        }
        if (Config::get('kitsoft.pages::routingByPages')) {
            return self::getPagesLink($model, $component);
        }
        return self::getCmsPagesLink($model, $component);
    }

    /**
     * getPagesLink
     */
    protected static function getPagesLink(Model $model, $component) {
        $page = Page::whereHas('components', function ($query) use ($component) {
            $query->where('name', $component);
        })->first();

        if (!$page) {
            return self::getDefaultLink($model);
        }

        $url = str_replace(':id', $model->id, $page->url);
        $url = str_replace(':slug', $model->slug, $url);

        return $url;
    }

    /**
     * getCmsPagesLink
     */
    protected static function getCmsPagesLink(Model $model, $component) {
        $pages = CmsPage::all();

        foreach ($pages as $page) {
            if (!$page->hasComponent($component)) continue;
            return $page->url($page->fileName, ['slug' => $model->slug]);
        }

        return self::getDefaultLink($model);
    }

    /**
     * getDefaultLink
     */
    protected static function getDefaultLink(Model $model) {
        switch (get_class($model)) {
            case 'RainLab\Blog\Models\Post':
                $route = 'news/';
                break;
            case 'KitSoft\Meetings\Models\Meeting':
                $route = 'meetings/';
                break;
            default:
                $route = '';
                break;
        }
        return "/{$route}{$model->slug}";
    }
}