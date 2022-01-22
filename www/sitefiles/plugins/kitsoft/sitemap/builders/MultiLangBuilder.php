<?php namespace KitSoft\Sitemap\Builders;

use App;
use KitSoft\Core\Classes\MultiLanguageHelpers;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\Sitemap\Builders\AbstractBuilder;
use KitSoft\Sitemap\Builders\Interfaces\BuilderInterface;

/**
 * MultiLangBuilder
 */
class MultiLangBuilder extends AbstractBuilder implements BuilderInterface
{
	public $lang;

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
	}

	/**
	 * build
	 */
	public function build()
	{
		$this->sitemap = App::make('sitemap-builder');

        MultiLanguageHelpers::langs()->each(function ($lang) {
        	$this->lang = $lang->code;

            MultiLanguage::instance()->setLocale($lang->code);

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
		return "{$this->folder}/{$this->prefix}-{$this->lang}";
	}

	/**
	 * getFile
	 */
	public function getFile($postfix = null)
	{
		if ($postfix == '.xml') {
			$path = base_path("{$this->folder}/{$this->prefix}{$postfix}");
			return @file_get_contents($path);
		}

		return parent::getFile($postfix);
	}
}