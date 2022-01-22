<?php namespace KitSoft\MultiLanguage\Classes;

use KitSoft\MultiLanguage\Classes\Interfaces\UrlGeneratorInterface;
use KitSoft\MultiLanguage\Classes\MultiLanguage;
use KitSoft\MultiLanguage\Models\Locale;
use Request;

/**
 * UrlGenerator
 */
class UrlGenerator implements UrlGeneratorInterface
{
	/**
	 * getLocalizedUrl
	 */
	public static function getLocalizedUrl(string $url): string {
		if (!isset($url)) {
			return '/';
		}

		if (MultiLanguage::instance()->isDefault()) {
			return $url;
		}

		return self::localize($url, true);
	}

	/**
	 * getUnlocalizedUrl
	 */
	public static function getUnlocalizedUrl(string $url): string
	{
		if (!isset($url)) {
			return '/';
		}

		return self::localize($url, false);
	}

	/**
	 * localize
	 */
	protected static function localize(string $url, bool $localize = true)
	{
		$path = parse_url($url, PHP_URL_PATH);	

		// if defferent hosts with current project, return
		if (self::isHostDifference($url)) {
			return $url;
		}

		// add or remove locale from segments
		$segments = explode('/', ltrim($path, '/'));
		$segments = self::prepareSegments($segments, $localize);

		return self::replaceUrlSegments($url, $segments);
	}

	/**
	 * prepareSegments
	 */
	protected static function prepareSegments(array $segments, bool $localize = true)
	{
		if ($localize && !Locale::isValid($segments[0]) && !in_array($segments[0], ['storage'])) {
			return array_prepend($segments, MultiLanguage::instance()->getActiveLocale());
		}

		if (!$localize && Locale::isValid($segments[0])) {
			unset($segments[0]);
		}

		return $segments;
	}

	/**
	 * replaceUrlSegments
	 */
	protected static function replaceUrlSegments(string $url, array $segments)
	{
		$_url = parse_url($url);

		$result = '';
		$result .= isset($_url['scheme']) ? "{$_url['scheme']}://" : '';
		$result .= self::getHostWithPort($url);
		$result .= '/' . implode('/', $segments);
		$result .= isset($_url['query']) ? "?{$_url['query']}" : '';

		return $result;
	}

	/**
	 * getHostWithPort
	 */
	protected static function getHostWithPort(string $string) {
		if (!$host = parse_url($string, PHP_URL_HOST)) {
			return;
		}

		$port = parse_url($string, PHP_URL_PORT);

		return $port
			? "{$host}:{$port}"
			: $host;
	}

	/**
	 * isHostDifference
	 */
	protected static function isHostDifference(string $string) {
		$host = self::getHostWithPort($string);

		return $host
			? (Request::getHttpHost() !== $host)
			: false;
	}
}
