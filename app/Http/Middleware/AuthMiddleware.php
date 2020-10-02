<?php


namespace MVCore\Http\Middleware;

use MVCore\Http\Router;
use Closure;

class AuthMiddleware
{
    public function handle(Closure $next)
    {
    	#LLamar a ORM para validación de datos
        if (!isset($_REQUEST['usuario']) || $_REQUEST['usuario'] === '') {
        	/*
			*	Lógica del Middleware...
        	*/
        	return header('Location:http://www.google1.com');
        }
        else return $next();
    }
}


