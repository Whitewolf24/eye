<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CheckOreoCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->cookie('oreo') || $request->cookie('oreo') !== 'user_logged_in') {
            return redirect()->route('login')->withErrors(['cookie' => 'You are not logged in.']);
        }


        // Proceed with the request if the cookie exists
        return $next($request);
    }
}
