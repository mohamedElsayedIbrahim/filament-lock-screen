<?php

namespace MohamedElsayedIbrahim\FilamentLockScreen;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Facades\FilamentView;
use Filament\View\PanelsRenderHook;

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
            FilamentView::registerRenderHook(
            PanelsRenderHook::BODY_END,
            fn (): string => view('filament-lock-screen::lock-screen')->render(),
        );
    }

    public static function make(): static
    {
        return new static();
    }
}