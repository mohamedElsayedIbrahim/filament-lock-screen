<?php

namespace Mohamed\FilamentLockscreen;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;

class FilamentLockScreenServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/filament-lock-screen.php', 'filament-lock-screen');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-lock-screen');

        $this->publishes([
            __DIR__.'/../config/filament-lock-screen.php' => config_path('filament-lock-screen.php'),
        ], 'filament-lock-screen-config');
    }
}