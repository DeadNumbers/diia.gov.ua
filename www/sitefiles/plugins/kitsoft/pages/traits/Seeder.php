<?php namespace KitSoft\Pages\Traits;

use KitSoft\Pages\Install\Helpers;
use KitSoft\Pages\Models\Component;
use KitSoft\Pages\Models\Page;
use KitSoft\Pages\Models\Section;

trait Seeder
{
    /**
     * createPage
     */
    protected function createPage($attributes, $componentIds, $sectionIds, $siteId = null, $locale = null)
    {
        extract($attributes);

        $page = Page::make();
        $page->title = $title ?? null;
        $page->slug = $slug ?? null;
        $page->layout = $layout ?? null;
        $page->published = $published ?? true;
        $page->parent_id = $parent_id ?? null;
        $page->sluggable = $sluggable ?? null;
        $page->fields = $fields ?? null;
        $page->content = $content ?? null;
        $page->is_system = $is_system ?? false;

        $page->components = $componentIds;
        $page->sections = $sectionIds;

        if ($siteId) {
            $page->asExtension('KitSoft\MultiSite\Behaviors\MultiSiteModel')->setSite($siteId);
        }
        
        if ($locale) {
            $page->asExtension('KitSoft\MultiLanguage\Behaviors\MultiLanguageModel')->setLang($locale);
        }
        
        $page->forceSave();

        return $page;
    }

    /**
     * createComponent
     */
    protected function createComponent($alias, $class, $properties = [], $published = true)
    {
        $component = Component::make();
        $component->name = $component->alias = $alias;
        $component->class = $class;
        $component->published = $published;
        $component->properties = $properties;
        $component->save();

        return $component;
    }

    /**
     * createSection
     */
    protected function createSection($code, $title, $fields = [], $published = true)
    {
        $fields = Helpers::prepareImages($fields);

        $section = Section::make();
        $section->name = $code;
        $section->title = $title;
        $section->published = $published;
        $section->fields = $fields;
        $section->save();

        return $section;
    }
}
