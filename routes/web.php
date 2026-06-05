<?php

use Illuminate\Support\Facades\Route;
use Mohamed\FilamentLockscreen\Filament\Pages\LockScreen;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get(config('lockscreen.route'), LockScreen::class)
        ->name('filament-lockscreen');
});