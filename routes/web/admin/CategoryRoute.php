<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'App\Http\Controllers\Admin\Category'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'CategoryController@index'
            ]);
            Route::post('/store', [
                'as' => 'store',
                'uses' => 'CategoryController@store'
            ]);

            Route::delete('/{category}/destroy', [
                'as' => 'destroy',
                'uses' => 'CategoryController@destroy'
            ]);
        });
        Route::group(['prefix' => 'categories-ajax', 'as' => 'categories.ajax.'], function () {
            Route::post('/getCategory', [
                'as' => 'getCategory',
                'uses' => 'CategoryAjaxController@getCategory'
            ]);
            Route::put('updateCategory', [
                'as' => 'updateCategory',
                'uses' => 'CategoryAjaxController@updateCategory'
            ]);
            Route::get('/category_type', [
                'as' => 'category_type',
                'uses' => 'CategoryAjaxController@categoryType'
            ]);
            Route::get('/category_child', [
                'as' => 'category_child',
                'uses' => 'CategoryAjaxController@categoryChild'
            ]);
        });
    });
});
