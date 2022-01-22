<?php namespace KitSoft\Core\Classes;

use Event;
use Response;

class CacheHelpers
{
	/**
	 * setNoCacheHeaders
	 */
	public static function setNoCacheHeaders()
	{
		Event::listen('cms.page.display', function ($controller, $url, $page, $result) {
            $headers = [
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0',
                'Pragma' => 'no-cache'
            ];

            return Response::make($result, $controller->getStatusCode(), $headers);
        });
	}
}