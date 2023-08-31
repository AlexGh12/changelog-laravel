<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::resource('/version', VersionController::class);
