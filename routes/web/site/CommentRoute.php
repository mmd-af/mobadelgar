<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers\Site\Comment'], function () {
    Route::group(['as' => 'site.'], function () {
        Route::group(['prefix' => 'comments-ajax', 'as' => 'comments.ajax.'], function () {
            Route::post('/getComments', [
                'as' => 'getComments',
                'uses' => 'CommentAjaxController@getComments'
            ]);
        });
    });
});
