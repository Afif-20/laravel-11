<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnableCors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  
     * @return  \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request)
        ->header('Access-Control-Allow-origin', '*')
        ->header('Access-Control-Allow-Method', 'GET, POST, PATCH, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, X-Token-Auth, Authorization');
    }
}
