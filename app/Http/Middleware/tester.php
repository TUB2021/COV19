<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class tester
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
      if (Auth::check() && Auth::user()->checkRole() == "tester"){
        return $next($request);
      }
        return redirect('/');
    }
}
