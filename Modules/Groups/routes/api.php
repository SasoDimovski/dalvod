<?php

use Illuminate\Support\Facades\Route;
use Modules\Groups\Http\Controllers\GroupsController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('groups', GroupsController::class)->names('groups');
});
