<?php namespace KitSoft\Digest\Classes;

use App;
use Flash;
use KitSoft\Digest\Models\Settings;

class RegisterDrivers
{
	/**
	 * __construct
	 */
	public function __construct()
	{
		if (!Settings::get('driver')) {
			return;
		}
		
		if (!$driver = $this->getEnabledDriverClass()) {
            Flash::warning('Digest Driver is not exist.');
            return;
        }

        App::make($driver);
	}

	/**
	 * getEnabledDriverClass
	 */
	protected function getEnabledDriverClass()
	{
		$driver = Settings::get('driver');

		return class_exists($driver)
			? $driver
			: false;
	}
}