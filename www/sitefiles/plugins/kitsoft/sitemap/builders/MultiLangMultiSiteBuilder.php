<?php namespace KitSoft\Sitemap\Builders;

use App;
use KitSoft\Core\Classes\MultiLanguageHelpers;
use KitSoft\Core\Classes\MultiSiteHelpers;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\MultiSite\Classes\MultiSite;
use KitSoft\Sitemap\Builders\AbstractBuilder;
use KitSoft\Sitemap\Builders\Interfaces\BuilderInterface;

/**
 * MultiLangMultiSiteBuilder
 */
class MultiLangMultiSiteBuilder extends AbstractBuilder implements BuilderInterface
{
	public $lang;
	public $site;

	/**
	 * sitemap index with content types
	 */
	protected $sitemap;

	/**
	 * __construct
	 */
	public function __construct()
	{
		parent::__construct();
		$this->lang = MultiLanguage::instance()->getActiveLocale();
		$this->site =  MultiSite::instance()->getCurrentSite();
	}

	/**
	 * build
	 */
	public function build()
	{
		MultiSiteHelpers::sites()->each(function ($site) {
			$this->sitemap = App::make('sitemap-builder');

            MultiLanguageHelpers::langs()->each(function ($lang) use ($site) {
            	$this->lang = $lang->code;
            	$this->site = $site;

                MultiLanguage::instance()->setLocale($lang->code);
                MultiSite::instance()->reinitSite($site->id);

                $this->getModels()->each(function ($model) {
                	$this->buildTypesSitemap($model::make());
            	});
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
		return "{$this->folder}/{$this->prefix}-{$this->site->id}-{$this->lang}";
	}

	/**
	 * getFile
	 */
	public function getFile($postfix = null)
	{
		if ($postfix == '.xml') {
			$path = base_path("{$this->folder}/{$this->prefix}-{$this->site->id}{$postfix}");
			return @file_get_contents($path);
		}

		return parent::getFile($postfix);		
	}
}