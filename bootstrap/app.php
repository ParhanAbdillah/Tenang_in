<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);

        // Tambahkan ini untuk mengatur tujuan setelah login
        $middleware->redirectTo(
            guests: '/login',
            users: '/mental-health-test/1', // Arahkan langsung ke halaman tes user
        );
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
