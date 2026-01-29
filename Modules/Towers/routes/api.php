<?php

use Illuminate\Support\Facades\Route;
use Modules\Towers\Http\Controllers\TowersController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('towers', TowersController::class)->names('towers');
});
