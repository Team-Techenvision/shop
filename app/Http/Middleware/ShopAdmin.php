<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ShopAdmin
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
        if (Auth::user() &&  Auth::user()->user_type == 7 && Auth::user()->is_block == 0) {
            return $next($request);
        }
        // return redirect('/')->with('message','User Account Block!!');
        return redirect('/');
    }
}
