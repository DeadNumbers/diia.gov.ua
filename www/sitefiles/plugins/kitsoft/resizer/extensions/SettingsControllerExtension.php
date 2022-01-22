<?php namespace KitSoft\Resizer\Extensions;

use Flash;
use Storage;
use System\Controllers\Settings;

class SettingsControllerExtension
{
    /*
     * Construct
     */
    public function __construct()
    {
    	Settings::extend(function ($controller) {
    		$controller->addDynamicMethod('onDeleteResizerThumbnails', function () {
                Storage::deleteDirectory('thumbnails');
			    Flash::success('Видалено.');
    		});
    	});
   	}
}
