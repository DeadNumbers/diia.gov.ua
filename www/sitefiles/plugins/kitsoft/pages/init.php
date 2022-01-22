<?php

/**
 * media_url
 */
if (function_exists('media_url')) {
	die('Helper "media_url" exists. Plugin KitSoft.Pages require it.');
} else {
	function media_url($path = null) {
		if (!isset($path)) {
			return;
		}

		$mediaPath = Config::get('cms.storage.media.path');

		return url($mediaPath . rawurlencode($path));
	}
}

/**
 * prepared_url
 */
if (function_exists('prepared_url')) {
	die('Helper "prepared_url" exists. Plugin KitSoft.Pages require it.');
} else {
	function prepared_url($path = null) {
		return url(\KitSoft\Core\Twig\UrlFilter::url($path));
	}
}

/**
 * prepared_secure_url
 */
if (function_exists('prepared_secure_url')) {
	die('Helper "prepared_secure_url" exists. Plugin KitSoft.Pages require it.');
} else {
	function prepared_secure_url($path = null) {
		return secure_url(\KitSoft\Core\Twig\UrlFilter::url($path));
	}
}