<?php namespace KitSoft\Core\Classes;

use Model;
use Schema;
use KitSoft\Core\Classes\StorageHelpers;

class ImportHelpers
{
    /**
     * strLimit
     */
    public static function strLimit($string, $limit, $postfix = '...')
    {
        if (iconv_strlen($string) > $limit) {
            $string = iconv_substr($string, 0, $limit - 3) . $postfix;
        }

        return $string;
    }

    /**
     * getSlug
     */
    public static function getSlug($string, $length = 191)
    {
        $string = str_slug($string);

        if (strlen($string) > $length) {
            $string = substr($string, 0, $length - 14) . '-' . uniqid();
        }

        return $string;
    }

    /**
     * getUniqueSlug
     */
    public static function getUniqueSlug(
        Model $model,
        string $value,
        string $field = 'slug',
        string $separator = '-',
        $maxLength = 191
    ): string {
        $counter = 1;
        $_value = $value = str_limit($value, $maxLength, '');

        while ($model::make()->where($field, $_value)->count()) {
            $counter++;
            $strLimit = $maxLength - strlen($counter) - strlen($separator);
            $_value = str_limit($value, $strLimit, '') . $separator . $counter;
        }

        return $_value;
    }

    /**
     * getModelBySourceId
     */
    public static function getModelBySourceId($model, $source_id)
    {
        return $model::whereRaw("fields::jsonb ->> 'source_id' = '{$source_id}'")
            ->first();
    }

    /**
     * getOrCreate
     */
    public static function getOrCreate($model, $name, $slug = null, $nameField = 'name')
    {
        $slug = $slug ?? str_slug($name);

        $hasSlug = Schema::hasColumn($model::make()->getTable(), 'slug');
        $object = $hasSlug
            ? $model::where('slug', $slug)->first()
            : $model::where('name', $name)->first();

        if (!$object) {
            $object = $model::make();
            $object->{$nameField} = $name;
            if ($hasSlug) {
                $object->slug = $slug;
            }
            $object->forceSave();
        }

        return $object->id;
    }

    /**
     * getContentImages
     */
    public static function getContentImages($content)
    {
        preg_match_all("/<img .*?(?=src)src=\"([^\"]+)\".*?>/si", $content, $matches);

        if (!isset($matches[1]) || empty($matches[1])) {
            return [];
        }

        return $matches[1];
    }

    /**
     * getContentLinks
     */
    public static function getContentLinks($content)
    {
        preg_match_all("/<a .*?(?=href)href=\"([^\"]+)\".*?>/si", $content, $matches);

        if (!isset($matches[1]) || empty($matches[1])) {
            return [];
        }

        return $matches[1];
    }

    /**
     * contentParseImages
     */
    public static function contentParseImages($content, $host = null, $mediaFolder = null)
    {
        if (!$images = self::getContentImages($content)) {
            return $content;
        }

        foreach ($contentParseImages as $key => $image) {
            $imageLink = $host ? $host . $image : $image;
            if ($imageLink = StorageHelpers::downloadFileToMedia($imageLink, $mediaFolder)) {
                $content = str_replace($image, $imageLink, $content);
            }
        }

        return $content;
    }
}