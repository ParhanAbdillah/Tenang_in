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

    // Ubah '/dashboard' menjadi '/' atau '/login'
   return redirect()->route('admin.dashboard.index')->with('error', 'Anda tidak memiliki akses admin.');
}
}
