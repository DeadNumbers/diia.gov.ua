<?php namespace KitSoft\Pages\Interfaces;

interface InstallerInterface
{
	public function __construct(array $config);
	public function install(): void;
}
