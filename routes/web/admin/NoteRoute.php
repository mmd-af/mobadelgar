<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'super.admin'], 'namespace' => 'App\Http\Controllers\Admin\Note'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'notes-ajax', 'as' => 'notes.ajax.'], function () {
            Route::delete('{note}/destroy', [
                'as' => 'destroy',
                'uses' => 'NoteAjaxController@destroy'
            ]);
        });
    });
});
