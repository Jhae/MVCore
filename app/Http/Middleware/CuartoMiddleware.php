<?php


namespace MVCore\Http\Middleware;

use MVCore\Http\Router;
use Closure;

class CuartoMiddleware
{
    public function handle(Closure $next)
    {
        if ($_REQUEST['usuario4'] !== 'asd' or !isset($_REQUEST['usuario4']))
        	return header('Location:http://www.g444oogle4.com');
        else return $next();
    }
}