<?php namespace KitSoft\Sitemap\Builders;

use App;
use KitSoft\Sitemap\Builders\AbstractBuilder;
use KitSoft\Sitemap\Builders\Interfaces\BuilderInterface;

/**
 * SingleSiteBuilder
 */
class SingleSiteBuilder extends AbstractBuilder implements BuilderInterface
{	
	/**
	 * build
	 */
	public function build()
	{
		$this->sitemap = App::make('sitemap-builder');

        $this->getModels()->each(function ($model) {
            $this->buildTypesSitemap($model::make());
        });
	}

	/**
	 * getRobotsTxtContent, for robots.txt
	 */
	public function getRobotsTxtContent()
	{
		return sprintf($this->robotsTxtMask, secure_url(''));
	}

	/**
	 * getSitemapIndexPath
	 */
	public function getSitemapIndexPath()
	{
		return "{$this->folder}/{$this->prefix}";
	}

	/**
	 * getSitemapPath
	 */
	public function getSitemapPath()
	{
		return "{$this->folder}/{$this->prefix}";
	}
}