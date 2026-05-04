<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    if ($request->user() && $request->user()->role === 'admin') {
        return $next($request);
    }

    // Redirect ke jembatan dashboard agar disesuaikan dengan role masing-masing
   return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses admin.');
}
}
