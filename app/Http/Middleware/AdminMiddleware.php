<?php


namespace MVCore\Http\Middleware;

use MVCore\Http\Router;
use Closure;

class AdminMiddleware
{
    public function handle(Closure $next)
    {
        if (!isset($_REQUEST['admin']) || !$_REQUEST['admin'] ) 
        	return header('Location:http://www.google2.com');
        else return $next();
    }
}