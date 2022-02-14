<?php

namespace Ajifatur\FaturHelper\Http\Middleware;

use Closure;
use Ajifatur\FaturHelper\Models\User;

class APIAuth
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
        // Get the user
        $user = User::where('access_token','=',$request->get('access_token'))->first();

        // Return
        if($user && $request->get('access_token') != null)
            return $next($request);
        else
            abort(401);
    }
}
