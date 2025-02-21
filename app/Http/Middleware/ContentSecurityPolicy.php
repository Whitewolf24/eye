<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $cspHeader =
        "default-src 'self'; script-src 'self' https://eye-mb66.onrender.com; style-src 'self'; img-src 'self' data:; font-src 'self'; connect-src 'self'; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';  report-uri /csp-violation-report-endpoint";
        $response = $next($request);
        $response->headers->set('Content-Security-Policy', $cspHeader);

        return $response;
        }
}
