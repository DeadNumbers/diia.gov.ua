<?php namespace KitSoft\Pages\Classes;

use Cms\Classes\CmsException;
use Cms\Classes\Layout;
use Cms\Classes\Page as CmsPage;
use Cms\Classes\Theme;
use KitSoft\Pages\Classes\PagesHelper;
use KitSoft\Pages\Classes\StringHelpers;
use Lang;
use October\Rain\Router\Helper as RouterHelper;
use Str;
use Config;

/**
 * Represents a page controller.
 */
class Controller
{
    use \October\Rain\Support\Traits\Singleton;

    protected $theme;
    protected $page;
    protected $segments;

    /**
     * Initialize this singleton.
     */
    protected function init()
    {
        $this->theme = Theme::getActiveTheme();
        if (!$this->theme) {
            throw new CmsException(Lang::get('cms::lang.theme.active.not_found'));
        }
    }

    /**
     * initCmsPage
     */
    public function initCmsPage($url, &$controller)
    {
        $url = Str::lower(RouterHelper::normalizeUrl($url));
        $url = ltrim($url, '/');
        $url = rtrim($url, '/');
        
        $this->segments = explode('/', $url);
        
        if (!$this->page = PagesHelper::getPageBySegments($this->segments)) {
            return;
        }

        // disable router pages, example: /news/:slug, /faq/:id, etc
        if (starts_with(last($this->segments), ':')) {
            return;
        }
        
        $cmsPage = CmsPage::inTheme($this->theme)->find($this->page->layout);
        $cmsPage->url = $this->page->url;
        $cmsPage->title = $this->page->title;

        $this->setMetaTags($cmsPage);
        $this->setOpenGraphTags($cmsPage);

        // add controller param [slug/id/etc]
        if ($this->page->sluggable) {
            $controller->setParameters(
                $this->getRequestParameters($this->page->sluggable_keys)
            );
        }

        $cmsPage->pagesModel = $this->page;

        return $cmsPage;
    }

    /**
     * getRequestParameters
     */
    protected function getRequestParameters(array $keys): array
    {
        if (!$count = count($keys)) {
            return [];
        }

        $values = array_slice(request()->segments(), -$count, $count, true);
        
        if (count($keys) !== count($values)) {
            return [];
        }

        return array_combine($keys, $values);
    }

    /**
     * setMetaTags
     */
    protected function setMetaTags(&$cmsPage) {
        $cmsPage->meta_title = isset($this->page->fields['meta_title']) && !empty($this->page->fields['meta_title'])
            ? $this->page->fields['meta_title']
            : $this->page->title;
        $cmsPage->meta_description = $this->page->fields['meta_description'] ?? null;
        $cmsPage->meta_keywords = $this->page->fields['meta_keywords'] ?? null;
    }

    /**
     * setOpenGraphTags
     */
    protected function setOpenGraphTags(&$cmsPage) {
        if (!isset($this->page->fields['og'], $this->page->fields['og']['image'])) {
            return;
        }

        if (empty($this->page->fields['og']['image'])) {
            return;
        }

        $cmsPage->og = ['image' => $this->page->fields['og']['image']];

        $cmsPage->og_image = url(Config::get('cms.storage.media.path') . $this->page->fields['og']['image']);
    }
}