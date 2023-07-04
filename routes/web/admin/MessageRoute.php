<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'super.admin'], 'namespace' => 'App\Http\Controllers\Admin\Message'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'messages', 'as' => 'messages.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'MessageController@index'
            ]);
            Route::post('/', [
                'as' => 'store',
                'uses' => 'MessageController@store'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'messages-ajax', 'as' => 'messages.ajax.'], function () {
            Route::get('/getDatatableData', [
                'as' => 'getDatatableData',
                'uses' => 'MessageAjaxController@getDatatableData'
            ]);
            Route::post('/showMesssage', [
                'as' => 'showMesssage',
                'uses' => 'MessageAjaxController@showMesssage'
            ]);
            Route::post('/showOrder', [
                'as' => 'showOrder',
                'uses' => 'MessageAjaxController@showOrder'
            ]);
        });
    });
});
