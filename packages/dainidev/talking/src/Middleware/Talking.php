<?php

namespace Dainidev\Talking\Middleware;

use Closure;

class Talking
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
        //echo "I am talking Middleware";
        return $next($request);
    }
}
