<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers\Site\Category'], function () {
    Route::group(['as' => 'site.'], function () {
        Route::group(['as' => 'categories.'], function () {
            Route::get('/{slug}', [
                'as' => 'show',
                'uses' => 'CategoryController@show'
            ]);
            Route::get('{category}/{slug}', [
                'as' => 'child',
                'uses' => 'CategoryController@child'
            ]);
        });
        Route::group(['prefix' => 'categories-ajax', 'as' => 'categories.ajax.'], function () {
            Route::post('/getCategories', [
                'as' => 'getCategories',
                'uses' => 'CategoryAjaxController@getCategories'
            ]);
            Route::post('/getAllCategories', [
                'as' => 'getAllCategories',
                'uses' => 'CategoryAjaxController@getAllCategories'
            ]);
        });
    });
});
