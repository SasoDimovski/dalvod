<?php

use Illuminate\Support\Facades\Route;
use Modules\Main\Http\Controllers\MainController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('main', MainController::class)->names('main');
});
