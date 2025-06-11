<?php

use Illuminate\Support\Facades\Route;
use Modules\Languages\Http\Controllers\LanguagesController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('languages', LanguagesController::class)->names('languages');
});
