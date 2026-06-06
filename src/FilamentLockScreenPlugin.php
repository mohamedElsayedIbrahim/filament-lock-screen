<?php

namespace MohamedElsayedIbrahim\FilamentLockScreen;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\View;

class FilamentLockScreenPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-lock-screen';
    }

    public function register(Panel $panel): void
    {
        $panel->middleware([
            \MohamedElsayedIbrahim\FilamentLockScreen\Http\Middleware\TrackUserActivity::class,
            \MohamedElsayedIbrahim\FilamentLockScreen\Http\Middleware\ForceLockScreen::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
            $panel->renderHook(
        PanelsRenderHook::BODY_END,
        fn () => View::make('filament-lockscreen::lockscreen')->render()
    );
    }

    public static function make(): static
    {
        return new static();
    }
}