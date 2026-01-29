<?php

use Illuminate\Support\Facades\Route;
use Modules\Towers\Http\Controllers\TowersController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('towers', TowersController::class)->names('towers');
});
