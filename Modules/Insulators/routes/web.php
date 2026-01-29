<?php

use Illuminate\Support\Facades\Route;
use Modules\Insulators\Http\Controllers\InsulatorsController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('insulators', InsulatorsController::class)->names('insulators');
});
