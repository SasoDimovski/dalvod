<?php

use Illuminate\Support\Facades\Route;
use Modules\GroundWires\Http\Controllers\GroundWiresController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('groundwires', GroundWiresController::class)->names('groundwires');
});
