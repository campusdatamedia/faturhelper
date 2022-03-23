<?php

namespace Ajifatur\FaturHelper\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Ajifatur\FaturHelper\Models\User;

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
        // Get the user ID
        if($request->is('api/*')) {
            $user = User::where('access_token','=',$request->get('access_token'))->first();
            $user_id = $user && $request->get('access_token') != null ? $user->id : null;
        }
        else
            $user_id = Auth::guard($guard)->check() ? $request->user()->id : null;

        // Save log
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/activities-'.date('Y').'-'.date('m').'.log'),
        ])->info(
            json_encode([
                'user_id' => $user_id,
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'ajax' => $request->ajax(),
                'ip' => $request->ip()
            ])
        );

        return $next($request);
    }
}
