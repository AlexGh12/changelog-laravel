<?php

use Illuminate\Support\Facades\Route;
use AlexGh12\ChangeLog\Http\Controllers\VersionController;

/*-------------------------------- Rutas vistas ------------------------------*/

Route::get('/', 'HomeController@index')->name('changelog');
Route::resource('/version', VersionController::class)->except(['show']);

/*------------------------------------------------------------------------*/

