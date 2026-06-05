<?php

namespace Mohamed\FilamentLockscreen\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LockscreenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return $next($request);
        }

        $last = session('filament_lockscreen_last_activity');
        $timeout = config('lockscreen.timeout');

        if ($last && now()->diffInSeconds($last) > $timeout) {
            session(['filament_lockscreen_locked' => true]);
        }

        session(['filament_lockscreen_last_activity' => now()]);

        return $next($request);
    }
}