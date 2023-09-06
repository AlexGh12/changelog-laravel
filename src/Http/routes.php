<?php

use Illuminate\Support\Facades\Route;

/*-------------------------------- Rutas vistas ------------------------------*/

Route::get('/', 'VersionController@index')->name('changelog');
Route::resource('/version', VersionController::class)->except(['show']);
/*------------------------------------------------------------------------*/

