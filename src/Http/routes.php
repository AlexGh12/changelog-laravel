<?php

use Illuminate\Support\Facades\Route;

/*-------------------------------- Rutas vistas ------------------------------*/
if ( env('APP_ENV', 'production') == 'local' ) {
    Route::get('/', 'VersionController@index')->name('changelog');
    Route::resource('/version', VersionController::class)->except(['show']);
}
/*------------------------------------------------------------------------*/

