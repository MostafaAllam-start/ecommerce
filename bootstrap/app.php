<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            Route::middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])
                ->prefix(LaravelLocalization::setLocale())
                ->group(function (){
                    Route::middleware('web')
                        ->prefix('admin')
                        ->group(base_path('routes/admin.php'));
                    Route::middleware('web')
                        ->group(base_path('routes/web.php'));
            });

        },
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => \App\Http\Middleware\User::class,
            'admin' => \App\Http\Middleware\Admin::class,
            /**** OTHER MIDDLEWARE ALIASES ****/
            'localize'                => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect'    => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect'   => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect'    => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath'          => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
