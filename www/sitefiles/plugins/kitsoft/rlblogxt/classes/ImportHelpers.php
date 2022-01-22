<?php namespace KitSoft\RLBlogXT\Classes;

use KitSoft\Core\Classes\StorageHelpers;
use KitSoft\Redirect\Models\Category as RedirectCategory;
use KitSoft\Redirect\Models\Redirect;
use KitSoft\TagsManager\Models\Tag;
use Model;
use RainLab\Blog\Models\Category;
use System\Classes\PluginManager;
use System\Models\File;

class ImportHelpers
{
	/**
     * getOrCreateCategory
     */
    public static function getOrCreateCategory(string $name): Category
    {
        $name = trim($name);
        
        if (!$category = Category::where('name', $name)->first()) {
            $category = Category::make();
            $category->name = $name;
            $category->slug = str_slug($name);
            $category->forceSave();
        }

        return $category;
    }

    /**
     * getOrCreateTag
     */
    public static function getOrCreateTag(string $name, string $slug = null): Tag
    {
        $name = trim($name);
        $slug = $slug ? str_slug($slug) : str_slug($name);
        
        if (!$tag = Tag::where('slug', $slug)->first()) {
            $tag = Tag::make();
            $tag->name = $name;
            $tag->slug = $slug;
            $tag->forceSave();
        }

        return $tag;
    }

    /**
     * createRedirect
     */
    public static function createRedirect(Model $object): void
    {
        if (!isset($object->fields['source_uri'])) {
            return;
        }

        if (!PluginManager::instance()->hasPlugin('KitSoft.Redirect')) {
            return;
        }

        $categoryName = class_basename($object);

        if (!$newsCategory = RedirectCategory::where('name', $categoryName)->first()) {
            $newsCategory = RedirectCategory::make();
            $newsCategory->name = $categoryName;
            $newsCategory->slug = str_slug($categoryName);
            $newsCategory->save();
        }

        $fromUrl = parse_url($object->fields['source_uri'], PHP_URL_PATH);

        if ($query = parse_url($object->fields['source_uri'], PHP_URL_QUERY)) {
            $fromUrl .= '?' . $query;
        }

        $redirect = Redirect::make();
        $redirect->from = $fromUrl;
        $redirect->to = $object->url;
        $redirect->status_code = 301;
        $redirect->is_enabled = true;
        $redirect->category = $newsCategory->id;
        
        $redirect->save();
    }

    /**
     * prepareContent
     */
    public static function prepareContent(string $content, string $host): string
    {
        $content = self::parseImages($content, $host);
        $content = self::parseLinks($content, $host);

        return $content;
    }

    /**
     * parseImages
     */
    protected static function parseImages(string $content, string $host): string
    {
        preg_match_all("/<img \n|.*?(?=src)src=\"([^\"]+)\".*?>/si", $content, $matches);

        if (!isset($matches[1]) || empty($matches[1])) {
            return $content;
        }

        foreach ($matches[1] as $image) {
            if (starts_with($image, 'file://')) {
                continue;
            }
            if (!pathinfo($image, PATHINFO_EXTENSION)) {
                continue;
            }
            $imageLink = self::download($image, $host);
            $content = str_replace("src=\"{$image}\"", "src=\"{$imageLink}\"", $content);
        }

        return $content;
    }

    /**
     * parseLinks
     */
    protected static function parseLinks(string $content, string $host): string
    {
        preg_match_all("/<a \n|.*?(?=href)href=\"([^\"]+)\".*?>/si", $content, $matches);

        if (!isset($matches[1]) || empty($matches[1])) {
            return $content;
        }

        foreach ($matches[1] as $link) {
            if (starts_with($link, 'file://')) {
                continue;
            }
            if (!pathinfo($link, PATHINFO_EXTENSION)) {
                continue;
            }
            $newLink = self::download($link, $host);
            $content = str_replace("href=\"{$link}\"", "href=\"{$newLink}\"", $content);
        }

        return $content;
    }

    /**
     * download
     */
    public static function download(string $url, string $host): string
    {
        if (starts_with($url, '../')) {
            return $url;
        }

        // donwload files only from current domain
        if (!$linkHost = parse_url($url, PHP_URL_HOST)) {
            $url = "http://{$host}/" . ltrim($url, '/');
        } elseif (!ends_with($linkHost, $host)) {
            return $url;
        }

        if (!$newUrl = StorageHelpers::downloadFileToMedia($url, 'imported_content')) {
            return $url;
        }

        return $newUrl;
    }

    /**
     * attachPostImage
     */
    public static function attachPostImage(string $url, string $filename = null, Model $object): void
    {
        $options = ['ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ]];

        if (!$image = @file_get_contents($url, false, stream_context_create($options))) {
            return;
        }

        $object->featured_images = (new File)->fromData($image, $filename ?? basename($url));
        $object->forceSave();
    }
}