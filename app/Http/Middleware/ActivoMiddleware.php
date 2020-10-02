<?php


namespace MVCore\Http\Middleware;

use MVCore\Http\Router;
use Closure;

class ActivoMiddleware
{
    public function handle(Closure $next)
    {
        if (!isset($_REQUEST['activo']) || !$_REQUEST['activo'] ) 
        	return header('Location:http://www.google3.com');
        else return $next();
    }
}