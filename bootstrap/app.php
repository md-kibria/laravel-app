<?php

use App\Http\Middleware\AdminAuth;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Admin middleware
        $middleware->alias([
            'admin' => AdminAuth::class,
        ]);
        $middleware->append([
            // Cache-Control middleware
            // 'cache' => \App\Http\Middleware\CacheControlMiddleware::class,
            \App\Http\Middleware\CacheControlMiddleware::class,
            \App\Http\Middleware\GzipMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
