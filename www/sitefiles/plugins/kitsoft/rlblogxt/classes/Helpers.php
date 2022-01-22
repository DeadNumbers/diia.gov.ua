<?php namespace KitSoft\RLBlogXT\Classes;

use Config;

class Helpers
{
	/**
	 * isMultimediaFinderEnabled
	 */
	public static function isMultimediaFinderEnabled()
	{
		return Config::get('kitsoft.rlblogxt::config.enablePostMultimediaFinder');
	}
}