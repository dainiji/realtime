<?php

namespace Dainidev\Talking\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Talking
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        

        

        if (!Auth::check()) {
            if ($request->ajax() || $request->wantsJson()) {
                //return response('Unauthorized.', 401);
                //echo "You need to login";
                //return response('',200);
                return response('Unauthorized.', 401);
            } 
        }
          
        return $next($request);
    }
}
