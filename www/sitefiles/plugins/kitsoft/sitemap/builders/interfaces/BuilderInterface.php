<?php namespace KitSoft\Sitemap\Builders\Interfaces;

/**
 * BuilderInterface
 */
interface BuilderInterface
{
	public function build();
	public function getRobotsTxtContent();
	public function getSitemapIndexPath();
	public function getSitemapPath();
}