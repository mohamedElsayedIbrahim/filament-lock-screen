<?php

use Illuminate\Support\Facades\Route;
use MohamedElsayedIbrahim\FilamentLockscreen\Filament\Pages\LockScreen;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/admin/lock-screen', LockScreen::class)
        ->name('filament-lockscreen');
});