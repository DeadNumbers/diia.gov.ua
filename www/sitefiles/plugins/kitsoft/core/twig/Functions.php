<?php namespace KitSoft\Core\Twig;

use KitSoft\Pages\Models\Page;

class Functions
{
    /**
     * getPage
     */
    public static function getPage(int $id)
    {
        return Page::isPublished()->find($id);
    }

    /**
     * getPageByComponent
     */
    public static function getPageByComponent(string $component, string $field = 'class')
    {
        return Page::isPublished()->whereHas('components', function ($query) use ($component, $field) {
            $query->where($field, $component);
        })->firstOrFail();
    }

    /**
     * getPageByTemplate
     */
    public static function getPageByTemplate(string $template) {
        return Page::isPublished()
            ->where('layout', $template)
            ->first();
    }

    /**
     * getTimelinePage
     */
    public static function getTimelinePage()
    {
        return self::getPageByComponent('timeline', 'alias');
    }

    /**
     * getTimelinePageUrl
     */
    public static function getTimelinePageUrl() {
        $page = self::getTimelinePage();
        
        return $page ? $page->url : null;
    }
}
