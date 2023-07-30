<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'super.admin'], 'namespace' => 'App\Http\Controllers\Admin\Category'], function () {
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
            Route::get('/{category}/', [
                'as' => 'show',
                'uses' => 'CategoryController@show'
            ]);
            Route::get('/{category}/{child}', [
                'as' => 'child',
                'uses' => 'CategoryController@child'
            ]);
            Route::post('/noteStore', [
                'as' => 'noteStore',
                'uses' => 'CategoryController@noteStore'
            ]);
            Route::delete('/{category}/destroy', [
                'as' => 'destroy',
                'uses' => 'CategoryController@destroy'
            ]);
        });
        Route::group(['prefix' => 'categories-ajax', 'as' => 'categories.ajax.'], function () {

            Route::post('changeCategoryPosition', [
                'as' => 'changeCategoryPosition',
                'uses' => 'CategoryAjaxController@changeCategoryPosition'
            ]);
            Route::post('/getCategory', [
                'as' => 'getCategory',
                'uses' => 'CategoryAjaxController@getCategory'
            ]);
            Route::put('updateCategory', [
                'as' => 'updateCategory',
                'uses' => 'CategoryAjaxController@updateCategory'
            ]);
            Route::put('updateContentCategory', [
                'as' => 'updateContentCategory',
                'uses' => 'CategoryAjaxController@updateContentCategory'
            ]);
            Route::post('categoryScriptStore', [
                'as' => 'categoryScriptStore',
                'uses' => 'CategoryAjaxController@categoryScriptStore'
            ]);
            Route::post('storeFaqCategory', [
                'as' => 'storeFaqCategory',
                'uses' => 'CategoryAjaxController@storeFaqCategory'
            ]);
            Route::post('showAllNote', [
                'as' => 'showAllNote',
                'uses' => 'CategoryAjaxController@showAllNote'
            ]);
            Route::post('showNote', [
                'as' => 'showNote',
                'uses' => 'CategoryAjaxController@showNote'
            ]);
        });
    });
});
