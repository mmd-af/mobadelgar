<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'super.admin'], 'namespace' => 'App\Http\Controllers\Admin\Comment'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'comments', 'as' => 'comments.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'CommentController@index'
            ]);
            Route::delete('/{comment}/destroy', [
                'as' => 'destroy',
                'uses' => 'CommentController@destroy'
            ]);
        });
        Route::group(['prefix' => 'comments-ajax', 'as' => 'comments.ajax.'], function () {
            Route::put('activeComment', [
                'as' => 'activeComment',
                'uses' => 'CommentAjaxController@activeComment'
            ]);
        });
    });
});
