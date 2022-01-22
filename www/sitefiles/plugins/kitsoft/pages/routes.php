<?php

Route::group(['prefix' => 'api'], function () {
    Route::post('backend-toolbar', 'KitSoft\Pages\Controllers\ApiBackend@toolbar');
});
