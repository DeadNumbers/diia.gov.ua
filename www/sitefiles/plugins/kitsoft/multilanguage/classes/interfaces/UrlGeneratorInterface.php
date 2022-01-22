<?php namespace KitSoft\MultiLanguage\Classes\Interfaces;

interface UrlGeneratorInterface
{
	public static function getLocalizedUrl(string $url): string;
	public static function getUnlocalizedUrl(string $url): string;
}