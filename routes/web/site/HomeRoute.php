<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers\Site\Home'], function () {
    Route::group(['as' => 'site.'], function () {
        Route::group(['as' => 'home.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'HomeController@homeIndex'
            ]);
            Route::get('/aboutus', [
                'as' => 'aboutus',
                'uses' => 'HomeController@aboutus'
            ]);
        });
    });
});
