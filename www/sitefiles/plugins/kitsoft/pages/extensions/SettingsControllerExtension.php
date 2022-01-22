<?php namespace KitSoft\Pages\Extensions;

use Cache;
use Flash;
use KitSoft\Pages\Install\Install;
use System\Controllers\Settings;
use Exception;
use ApplicationException;

class SettingsControllerExtension
{
	protected $cacheKey = 'kitsoft.pages::pages_install_in_process';

    /*
     * Construct
     */
    public function __construct()
    {
    	Settings::extend(function ($controller) {
    		$controller->addDynamicMethod('onInstallPages', function () {
                ini_set('memory_limit', '-1');

    			if (Cache::get($this->cacheKey)) {
    				throw new ApplicationException('Install in process');
    			}

		    	try {
		    		Cache::put($this->cacheKey, true, 5);
			    	$installer = new Install();
			    	$installer->install();
			    } catch (Exception $e) {
			    	trace_log($e);
			    }

			    Cache::forget($this->cacheKey);

			    Flash::success('Установку завершено.');
    		});
    	});
   	}
}
