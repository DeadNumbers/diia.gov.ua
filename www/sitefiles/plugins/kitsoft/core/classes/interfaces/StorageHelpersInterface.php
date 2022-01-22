<?php namespace KitSoft\Core\Classes\Interfaces;

interface StorageHelpersInterface
{
	public static function downloadFileToMedia($fileLink, $folder = null, $basename = false);
	public static function saveFile($fileContent, $fileName, $folder = null);
    public static function unzip(string $filepath): string;
	public static function getFileExtension($fileContent);
	public static function getResourceExtension($resource): string;
}
