<?php

Route::group(['prefix' => 'api/v1'], function () {
	Route::get('menu/{slug}', 'KitSoft\Diia\Controllers\ApiMenu@show');
	Route::get('services/categories', 'KitSoft\Diia\Controllers\ApiServices@categories');
    Route::get('health', 'KitSoft\Diia\Controllers\ApiHealth@health' );
});

