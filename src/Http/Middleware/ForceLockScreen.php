<?php

namespace MohamedElsayedIbrahim\FilamentLockscreen\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceLockScreen
{
    public function handle($request, Closure $next)
{
    if (!auth()->check()) {
        return $next($request);
    }

    $last = session('fls_last_activity');
    $timeout = config('filament-lock-screen.timeout');

    if ($last && now()->diffInSeconds($last) > $timeout) {
        session(['fls_locked' => true]);
    }

    return $next($request);
}
}