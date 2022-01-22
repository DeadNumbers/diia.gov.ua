<?php

use RainLab\Blog\Models\Post;

Route::group(['prefix' => 'api'], function () {

    Route::get('news', 'KitSoft\RLBlogXT\Controllers\ApiNewsController@index');

    Route::group(['prefix' => 'blog'], function () {
        Route::get('hit/{slug}', function ($slug) {
            if ($object = Post::where('slug', $slug)->isPublished()->first()) {
                $object->increment('hits');
            }
            return response()->json([
                'data' => 'OK',
            ]);
        });
    });
});