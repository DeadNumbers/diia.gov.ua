<?php namespace KitSoft\Search\Console\Interfaces;

interface ElasticCommandInterface
{
	public function handle();
	public function runLocale(string $locale): void;
	public function runMultiLanguage(): void;
}