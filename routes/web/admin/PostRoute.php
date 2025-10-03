<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'super.admin'], 'namespace' => 'App\Http\Controllers\Admin\Post'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'PostController@index'
            ]);
            Route::post('/store', [
                'as' => 'store',
                'uses' => 'PostController@store'
            ]);
            Route::get('/{post}/', [
                'as' => 'show',
                'uses' => 'PostController@show'
            ]);
            Route::get('/{post}/{child}', [
                'as' => 'child',
                'uses' => 'PostController@child'
            ]);
            Route::post('/noteStore', [
                'as' => 'noteStore',
                'uses' => 'PostController@noteStore'
            ]);
            Route::delete('/{post}/destroy', [
                'as' => 'destroy',
                'uses' => 'PostController@destroy'
            ]);
        });
        Route::group(['prefix' => 'posts-ajax', 'as' => 'posts.ajax.'], function () {

            Route::post('changePostPosition', [
                'as' => 'changePostPosition',
                'uses' => 'PostAjaxController@changePostPosition'
            ]);
            Route::post('/getPost', [
                'as' => 'getPost',
                'uses' => 'PostAjaxController@getPost'
            ]);
            Route::put('updatePost', [
                'as' => 'updatePost',
                'uses' => 'PostAjaxController@updatePost'
            ]);
            Route::put('updateContentPost', [
                'as' => 'updateContentPost',
                'uses' => 'PostAjaxController@updateContentPost'
            ]);
            Route::post('postScriptStore', [
                'as' => 'postScriptStore',
                'uses' => 'PostAjaxController@postScriptStore'
            ]);
            Route::post('postInsidelinkStore', [
                'as' => 'postInsidelinkStore',
                'uses' => 'PostAjaxController@postInsidelinkStore'
            ]);
            Route::post('storeFaqPost', [
                'as' => 'storeFaqPost',
                'uses' => 'PostAjaxController@storeFaqPost'
            ]);
            Route::post('showAllNote', [
                'as' => 'showAllNote',
                'uses' => 'PostAjaxController@showAllNote'
            ]);
            Route::post('showNote', [
                'as' => 'showNote',
                'uses' => 'PostAjaxController@showNote'
            ]);
        });
    });
});
