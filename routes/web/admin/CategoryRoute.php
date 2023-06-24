<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'permission:categoryManager'], 'namespace' => 'App\Http\Controllers\Admin\Category'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'CategoryController@index'
            ]);
            Route::get('/create', [
                'as' => 'create',
                'uses' => 'CategoryController@create'
            ]);
            Route::post('/store', [
                'as' => 'store',
                'uses' => 'CategoryController@store'
            ]);
            Route::get('/{category}/edit', [
                'as' => 'edit',
                'uses' => 'CategoryController@edit'
            ]);
            Route::put('{category}/update', [
                'as' => 'update',
                'uses' => 'CategoryController@update'
            ]);
            Route::delete('/{category}/destroy', [
                'as' => 'destroy',
                'uses' => 'CategoryController@destroy'
            ])->middleware('permission:delete');
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'categories-ajax', 'as' => 'categories.ajax.'], function () {
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


