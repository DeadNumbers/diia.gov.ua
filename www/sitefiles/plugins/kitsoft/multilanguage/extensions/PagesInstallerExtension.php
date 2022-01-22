<?php namespace KitSoft\MultiLanguage\Extensions;

use Event;
use KitSoft\MultiLanguage\Classes\MultiLanguage;

class PagesInstallerExtension
{
	/**
	 * __construct
	 */
	public function __construct() {
		Event::listen('kitsoft.pages::install.helpers.getConfigDirectory', function (&$path) {
			$_path = $path . '/' . MultiLanguage::instance()->getActiveLocale();

			if (file_exists($_path)) {
				$path = $_path;
			}
		});
	}
}
