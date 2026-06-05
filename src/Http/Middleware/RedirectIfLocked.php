<?php

namespace Mohamed\FilamentLockscreen\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfLocked
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && session('filament_lockscreen_locked')) {

            if (!str_contains($request->path(), config('lockscreen.route'))) {
                return redirect(config('lockscreen.route'));
            }
        }

        return $next($request);
    }
}