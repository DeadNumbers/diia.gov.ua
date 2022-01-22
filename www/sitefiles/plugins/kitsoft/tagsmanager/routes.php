<?php

use System\Classes\PluginManager;

Route::group(['prefix' => 'api/tagsmanager'], function () {
	if (PluginManager::instance()->hasPlugin('KitSoft.RestApi')) {
    	Route::apiResource('tags', 'KitSoft\TagsManager\RestApi\Tags');
    }
});