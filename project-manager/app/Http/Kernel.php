<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Daftar middleware global (berjalan di semua request).
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Middleware yang berlaku untuk route tertentu.
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'level' => \App\Http\Middleware\CheckLevel::class, // Tambahkan middleware level
        'Admininstrator' => \App\Http\Middleware\AdminMiddleware::class,
    ];
}
