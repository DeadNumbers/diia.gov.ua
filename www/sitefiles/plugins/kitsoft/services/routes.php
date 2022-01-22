<?php

Route::group(['prefix' => 'api/service_form'], function(){
    Route::post('send', 'KitSoft\Services\Classes\ServiceForm@receive');
});