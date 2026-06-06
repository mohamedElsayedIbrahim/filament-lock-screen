<?php

namespace Mohamed\FilamentLockscreen;

use Illuminate\Support\ServiceProvider;

class FilamentLockScreenServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/filament-lock-screen.php',
            'filament-lock-screen'
        );
    }

    public function boot(): void
    {
        $this->loadViewsFrom(
            __DIR__.'/../resources/views',
            'filament-lock-screen'
        );

        $this->publishes([
            __DIR__.'/../config/filament-lock-screen.php' 
                => config_path('filament-lock-screen.php'),
        ], 'filament-lock-screen-config');

        $this->publishes([
            __DIR__.'/../resources/views' 
                => resource_path('views/vendor/filament-lock-screen'),
        ], 'filament-lock-screen-views');
    }
}