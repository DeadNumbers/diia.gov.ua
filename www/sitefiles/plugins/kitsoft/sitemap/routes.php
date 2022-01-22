<?php

use KitSoft\Sitemap\Classes\Helpers;

Event::listen('cms.router.beforeRoute', function ($slug) {
	try {
		preg_match('/^\/sitemap(.*).xml$/', $slug, $matches);
	} catch (Exception $e) {
		return;
	}
	
	if (!count($matches)) {
		return;
	}

    if (!$file = Helpers::getBuilder()->getFile($matches[1] . '.xml')) {
    	return;
    }

    response($file, 200, [
	    'Content-Type' => 'application/xml'
	])->send();

	die;
});