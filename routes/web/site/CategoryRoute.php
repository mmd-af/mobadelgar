<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers\Site\Category'], function () {
    Route::group(['prefix' => 'site', 'as' => 'site.'], function () {
        Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {

        });
        Route::group(['prefix' => 'categories-ajax', 'as' => 'categories.ajax.'], function () {
            Route::get('/getCategories', [
                'as' => 'getCategories',
                'uses' => 'CategoryAjaxController@getCategories'
            ]);
        });
    });
});
