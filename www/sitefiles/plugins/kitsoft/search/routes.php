<?php

Route::group(['prefix' => 'api/search'], function () {
	Route::get('/', 'KitSoft\Search\Classes\SearchResolver@requestHandler');
	Route::get('types', 'KitSoft\Search\Controllers\Search@getTypes');
});