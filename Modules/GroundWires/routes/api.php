<?php

use Illuminate\Support\Facades\Route;
use Modules\GroundWires\Http\Controllers\GroundWiresController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('groundwires', GroundWiresController::class)->names('groundwires');
});
