<?php

use Illuminate\Support\Facades\Route;
use MohamedElsayedIbrahim\FilamentLockscreen\Filament\Pages\LockScreen;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get(config('lockscreen.route'), LockScreen::class)
        ->name('filament-lockscreen');
});

Route::get('/admin/lock-screen', function () {
    app(\MohamedElsayedIbrahim\FilamentLockscreen\Contracts\LockScreenContract::class)
        ->lock();

    return redirect()->route('filament.admin.auth.login');
})->name('filament.lock-screen.lock');