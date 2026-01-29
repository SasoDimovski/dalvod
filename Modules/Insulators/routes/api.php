<?php

use Illuminate\Support\Facades\Route;
use Modules\Insulators\Http\Controllers\InsulatorsController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('insulators', InsulatorsController::class)->names('insulators');
});
