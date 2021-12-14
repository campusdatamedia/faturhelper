<?php

namespace Ajifatur\FaturHelper\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
        if(Auth::guard($guard)->check() && is_int(strpos($request->url(), route('auth.login'))) && $request->user()->role->is_admin == 1) {
            return redirect()->route('admin.dashboard');
        }
        elseif(Auth::guard($guard)->check() && is_int(strpos($request->url(), route('auth.login'))) && $request->user()->role->is_admin == 0) {
            return redirect('/');
        }

        return $next($request);
    }
}
