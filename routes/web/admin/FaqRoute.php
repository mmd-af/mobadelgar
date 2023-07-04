<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'super.admin'], 'namespace' => 'App\Http\Controllers\Admin\Faq'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'faqs-ajax', 'as' => 'faqs.ajax.'], function () {
            Route::delete('{faq}/destroy', [
                'as' => 'destroy',
                'uses' => 'FaqAjaxController@destroy'
            ]);
        });
    });
});
