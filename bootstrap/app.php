<?php

use App\Console\Commands\ProcessAutoRenewal;
use App\Http\Middleware\CheckSubscription;
use Illuminate\Console\Scheduling\Schedule;
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
        $middleware->alias([
            'check.subscription' => CheckSubscription::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
     ->withSchedule(function (Schedule $schedule) {
        $schedule->command('billing:auto-renew')->dailyAt('00:00');
    })
    ->withCommands([
        ProcessAutoRenewal::class, // ✅ Register command
    ])->create();
