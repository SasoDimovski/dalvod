<?php

use Illuminate\Support\Facades\Route;
use Modules\Conductors\Http\Controllers\ConductorsController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('conductors', ConductorsController::class)->names('conductors');
});
