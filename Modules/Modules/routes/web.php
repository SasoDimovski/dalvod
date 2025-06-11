<?php

use Illuminate\Support\Facades\Route;
use Modules\Modules\Http\Controllers\ModulesController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('modules', ModulesController::class)->names('modules');
});
