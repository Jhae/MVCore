<?php
namespace MVCore\Http;

class Kernel
{
    static $routeMiddlewares = [
        //'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth' => \MVCore\Http\Middleware\AuthMiddleware::class,
        'admin' => \MVCore\Http\Middleware\AdminMiddleware::class,
        'activo' => \MVCore\Http\Middleware\ActivoMiddleware::class,
        'cuarto' => \MVCore\Http\Middleware\CuartoMiddleware::class,
    ];

}