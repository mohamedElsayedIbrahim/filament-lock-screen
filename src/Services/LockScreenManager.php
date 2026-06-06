<?php

namespace MohamedElsayedIbrahim\FilamentLockScreen\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use MohamedElsayedIbrahim\FilamentLockScreen\Contracts\LockScreenContract;

class LockScreenManager implements LockScreenContract
{
    public function isLocked(): bool
    {
        return session('filament_lockscreen_locked', false);
    }

    public function lock(): void
    {
        session(['filament_lockscreen_locked' => true]);
    }

    public function unlock(string $password): bool
    {
        $user = auth('web')->user();

        if (!$user instanceof Authenticatable) {
            return false;
        }

        if (! $this->validateCredentials($user, $password)) {
            return false;
        }

        session()->forget('filament_lockscreen_locked');

        $this->updateLastActivity();

        return true;
    }

    public function validateCredentials(Authenticatable $user, string $password): bool
    {
        return Hash::check($password, $user->password);
    }

    public function getLastActivity(): ?\DateTimeInterface
    {
        return session('filament_lockscreen_last_activity');
    }

    public function updateLastActivity(): void
    {
        session([
            'filament_lockscreen_last_activity' => now(),
        ]);
    }

    public function hasTimedOut(): bool
    {
        $last = $this->getLastActivity();

        if (! $last) {
            return false;
        }

        $timeout = config('filament-lock-screen.timeout', 900);

        return now()->diffInSeconds($last) > $timeout;
    }

    public function getLockScreenUrl(): string
    {
        return url(config('filament-lock-screen.route', 'admin/lock-screen'));
    }
}