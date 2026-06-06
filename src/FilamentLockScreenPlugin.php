<?php

namespace MohamedElsayedIbrahim\FilamentLockScreen;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\View;
use MohamedElsayedIbrahim\FilamentLockscreen\Http\Middleware\ForceLockScreen;
use MohamedElsayedIbrahim\FilamentLockscreen\Http\Middleware\TrackUserActivity;

class FilamentLockScreenPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-lock-screen';
    }

    public function register(Panel $panel): void
    {
        $panel->middleware([
            TrackUserActivity::class,
            ForceLockScreen::class,
        ]);

        $panel->userMenuItems([
            'lock-screen' => \Filament\Navigation\MenuItem::make()
                ->label('Lock Screen')
                ->icon('heroicon-o-lock-closed')
                ->url(route('filament.lock-screen.lock'))
                ->sort(100),
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