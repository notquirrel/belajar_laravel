<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if(!$request->session()->has('name')){
            return redirect('/');
        }
        return $next($request);
    }
}
