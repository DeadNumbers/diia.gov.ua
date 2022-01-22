<?php namespace KitSoft\MultiLanguage\Classes\Interfaces;

interface MultiLanguageInterface
{
	public function init();
	public function setLocale($locale);
	public function getDefaultLocale();
	public function getActiveLocale();
	public function getExternalActiveLocale($locale = null);
	public function isLocalizedRoute();
	public function isDefault();
	public function loadLocaleFromRequest();
}