<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class testCenterOfficer
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
      if (Auth::check() && Auth::user()->checkRole() == "testCenterManager" || Auth::user()->checkRole() == "tester"){
        return $next($request);
      }
        return redirect('/');
    }
}
