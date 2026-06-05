<?php

namespace Mohamed\FilamentLockscreen;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;

class LockscreenServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/lockscreen.php', 'lockscreen');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-lockscreen');

        $this->publishes([
            __DIR__.'/../config/lockscreen.php' => config_path('lockscreen.php'),
        ], 'filament-lockscreen-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/filament-lockscreen'),
        ], 'filament-lockscreen-views');
    }
}