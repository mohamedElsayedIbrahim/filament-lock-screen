<?php

namespace Mohamed\FilamentLockScreen;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentLockScreenPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-lock-screen';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->middleware([
                \Mohamed\FilamentLockScreen\Http\Middleware\TrackUserActivity::class,
                \Mohamed\FilamentLockScreen\Http\Middleware\ForceLockScreen::class,
            ])
            ->renderHook(
                'body.end',
                fn () => view('filament-lock-screen::lock-screen')
            );
    }

    public static function make(): static
    {
        return new static();
    }
}