<?php namespace KitSoft\TagsManager\Twig;

use Cache;
use KitSoft\Core\Twig\Functions as CoreFunctions;
use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\TagsManager\Models\Tag;

class Functions
{
    /**
     * tagLink
     */
    public static function tagLink($tag, $template = 'tag')
    {
        $routePageId = Cache::remember('kitsoft.tagsmanager::tagRoutePage', 5, function () use ($template) {
            $routePage = CoreFunctions::getPageByTemplate($template);
            return $routePage ? $routePage->id : null;
        });

        $slug = ($tag instanceof Tag)
            ? $tag->slug
            : $tag;

        return PagesHelper::url($routePageId, ['slug' => $slug]);
    }

    /**
     * tagLinkTimeline
     */
    public static function tagLinkTimeline($tag)
    {
        $timelineUrl = Cache::remember('kitsoft.tagsmanager::timelinePageUrl', 5, function () {
            return CoreFunctions::getTimelinePageUrl();
        });

        $name = ($tag instanceof Tag)
            ? $tag->name
            : $tag;

        return "{$timelineUrl}?&type=all&tag={$name}";
    }
}
