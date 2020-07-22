<?php

namespace App\Http\Middleware;

use Closure;

class TerminableMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $value)
    {
        echo $value;
        return $next($request);
    }

    public function terminate() 
    {
        echo '<br>';
        echo 'Terminable';
    }
}
