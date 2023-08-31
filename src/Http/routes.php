<?php

use AlexGh12\ChangeLog\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::resource('changelog', HomeController::class);
