<?php

use Illuminate\Support\Facades\Route;

Route::get('/script-test', function () {
    return view('site.categories.script-test');
})->middleware(['web', 'auth', 'super.admin']);

Route::get('/migrate', function () {
    Artisan::call('migrate');
    return Artisan::output();
})->middleware(['web', 'auth', 'super.admin']);

Route::get('/optimize', function () {
    Artisan::call('optimize');
    return Artisan::output();
})->middleware(['web', 'auth', 'super.admin']);

Route::get('/storage', function () {
    Artisan::call('storage:link');
    return Artisan::output();
})->middleware(['web', 'auth', 'super.admin']);
