<?php namespace KitSoft\Sitemap\Builders;

use App;
use KitSoft\Core\Classes\MultiSiteHelpers;
use KitSoft\MultiSite\Classes\MultiSite;
use KitSoft\Sitemap\Builders\AbstractBuilder;
use KitSoft\Sitemap\Builders\Interfaces\BuilderInterface;

/**
 * MultiSiteBuilder
 */
class MultiSiteBuilder extends AbstractBuilder implements BuilderInterface
{
	public $site;

	/**
	 * __construct
	 */
	public function __construct()
	{
		parent::__construct();
		$this->site =  MultiSite::instance()->getCurrentSite();
	}

	/**
	 * build
	 */
	public function build()
	{
        MultiSiteHelpers::sites()->each(function ($site) {
        	$this->site = $site;
            $this->sitemap = App::make('sitemap-builder');

            MultiSite::instance()->reinitSite($site->id);

            $this->getModels()->each(function ($model) {
                $this->buildTypesSitemap($model::make());
            });
        });
	}

	/**
	 * getRobotsTxtContent, for robots.txt
	 */
	public function getRobotsTxtContent()
	{
		$content = '';

		MultiSiteHelpers::sites()->each(function ($site) use (&$content) {
            $content .= sprintf($this->robotsTxtMask, $site->secure_domain);
        });

        return $content;
	}

	/**
	 * getSitemapIndexPath
	 */
	public function getSitemapIndexPath()
	{
		return "{$this->folder}/{$this->prefix}-{$this->site->id}";
	}

	/**
	 * getSitemapPath
	 */
	public function getSitemapPath()
	{
		return "{$this->folder}/{$this->prefix}-{$this->site->id}";
	}
}