<?php

use Illuminate\Support\Facades\Route;
use Modules\Conductors\Http\Controllers\ConductorsController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('conductors', ConductorsController::class)->names('conductors');
});
