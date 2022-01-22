<?php namespace KitSoft\MultiLanguage\Classes\Interfaces;

use Model;

interface LocaleSwitcherInterface
{
	public function __construct(Model $object);
	public function getLinks(): array;
	public function getLinkByLocale(string $locale);
}