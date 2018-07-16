<?php

namespace App\Http\Middleware;

use Closure;
use Socialite;

class FacebookAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $user = Socialite::driver('facebook')->user();
        return $next($request);

        // return $user;
    }
}
