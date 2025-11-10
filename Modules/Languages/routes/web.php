<?php

use Illuminate\Support\Facades\Route;
use Modules\Languages\Http\Controllers\LanguagesController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('languages', LanguagesController::class)->names('languages');
});
