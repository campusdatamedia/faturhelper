<?php

namespace Ajifatur\FaturHelper\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Logs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/activities.log'),
        ])->info(
            json_encode([
                'user_id' => Auth::guard($guard)->check() ? $request->user()->id : null,
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'ip' => $request->ip()
            ])
        );

        return $next($request);
    }
}
