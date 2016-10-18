<?php

namespace facilfincaraiz\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use facilfincaraiz\Http\Middleware\SuperAdmin;
use facilfincaraiz\Http\Middleware\Usuario;
use facilfincaraiz\Http\Middleware\Admin;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \facilfincaraiz\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \facilfincaraiz\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \facilfincaraiz\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \facilfincaraiz\Http\Middleware\RedirectIfAuthenticated::class,

        'superAdmin'=>SuperAdmin::class,
        'admin'=>Admin::class,
        'usuario'=>Usuario::class,
    ];
}
