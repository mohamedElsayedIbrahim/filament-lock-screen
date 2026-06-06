<?php

namespace MohamedElsayedIbrahim\FilamentLockscreen\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrackUserActivity
{
    public function handle($request, Closure $next)
{
    if (auth()->check()) {
        session([
            'fls_last_activity' => now(),
        ]);
    }

    return $next($request);
}
}