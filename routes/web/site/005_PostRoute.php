<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers\Site\Post'], function () {
    Route::group(['as' => 'site.'], function () {
        Route::group(['prefix' => 'blog', 'as' => 'posts.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'PostController@index'
            ]);
            Route::get('/{slug}', [
                'as' => 'show',
                'uses' => 'PostController@show'
            ]);
            Route::get('{post}/{slug}', [
                'as' => 'child',
                'uses' => 'PostController@child'
            ]);
        });
        Route::group(['prefix' => 'posts-ajax', 'as' => 'posts.ajax.'], function () {
            Route::post('/getPosts', [
                'as' => 'getPosts',
                'uses' => 'PostAjaxController@getPosts'
            ]);
            Route::post('/getAllPosts', [
                'as' => 'getAllPosts',
                'uses' => 'PostAjaxController@getAllPosts'
            ]);
        });
    });
});
