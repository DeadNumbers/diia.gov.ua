<?php

use KitSoft\MultiLanguage\Models\Locale;
use KitSoft\MultiLanguage\Classes\MultiLanguage;

/*
 * Adds a custom route to check for the locale prefix.
 */
App::before(function ($request) {
    if (App::runningInBackend()) {
        return;
    }

    $ml = MultiLanguage::instance();
    $locale = $ml->getActiveLocale();

    if (!$ml->loadLocaleFromRequest()) {
        return;
    }

    /*
     * Register routes
     */
    Route::group(['prefix' => $locale], function () {
        Route::any('{slug}', 'Cms\Classes\CmsController@run')->where('slug', '(.*)?');
    });

    Route::any($locale, 'Cms\Classes\CmsController@run')->middleware('web');

    /*
     * Ensure Url::action() retains the localized URL
     * by re-registering the route after the CMS.
     */
    Event::listen('cms.route', function () use ($locale) {
        Route::group(['prefix' => $locale, 'multilanguage' => true], function () {
            Route::any('{slug}', 'Cms\Classes\CmsController@run')->where('slug', '(.*)?')->middleware('web');
        });
    });
});

/*
 * Api
 */
Route::group(['prefix' => 'api'], function () {
    Route::group(['prefix' => 'multilanguage', 'middleware' => 'web'], function () {
        Route::get('', function () {
            if (!BackendAuth::check()) {
                return Redirect::to('404');
            }
            $items = Locale::listEnabled();

            return response()->json($items);
        });
    });
});
