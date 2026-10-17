<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class BranchMiddleware
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
        if (Auth::check()) {

            if (Auth::user()->its_user_type == 4) {
                return $next($request);
            }
        }
        return redirect()->route('login');
    }
}
