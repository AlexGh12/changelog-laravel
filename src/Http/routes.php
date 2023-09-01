<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('changelog');
Route::resource('/version', VersionController::class);
