<?php

use Illuminate\Support\Facades\Route;

Route::resource('/', HomeController::class)->name('changelog');
