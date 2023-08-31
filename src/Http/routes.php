<?php

use Illuminate\Support\Facades\Route;

Route::get('/list', [HomeController::class, 'index']);
Route::resource('/version', VersionController::class);
