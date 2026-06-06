<?php

namespace MohamedElsayedIbrahim\FilamentLockscreen\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;

class LockScreen extends Page
{
    protected static string $view = 'filament-lockscreen::lock-screen';

    protected static bool $shouldRegisterNavigation = false;

    public $password = '';

    public function mount(): void
    {
        if (!session('filament_lockscreen_locked')) {
            $this->redirect('/admin');
        }
    }

    public function unlock(): void
    {
        $user = auth('web')->user();

        if (!Hash::check($this->password, $user->password)) {
            Notification::make()
                ->title('Incorrect password')
                ->danger()
                ->send();

            return;
        }

        session()->forget('filament_lockscreen_locked');
        session(['filament_lockscreen_last_activity' => now()]);

        $this->redirect('/admin');
    }
}