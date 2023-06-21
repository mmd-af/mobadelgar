<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'admin'], 'namespace' => 'App\Http\Controllers\Admin\User'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'UserController@index'
            ]);
            Route::get('/{user}/edit', [
                'as' => 'edit',
                'uses' => 'UserController@edit'
            ]);
            Route::put('{user}/update', [
                'as' => 'update',
                'uses' => 'UserController@update'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'users-ajax', 'as' => 'users.ajax.'], function () {
            Route::get('/getDatatableData', [
                'as' => 'getDatatableData',
                'uses' => 'UserAjaxController@getDatatableData'
            ]);
        });
    });
});
