<?php
use MVCore\Http\Router;


function url(string $url):string
{
    $prefix = require 'config/view.php';
	$actual_link = 'http'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 's' : '')."://$_SERVER[HTTP_HOST]";
    return $actual_link.$prefix . $url;
}

#Retorna la ruta absoluta dado el nombre de una ruta relativa declarada;
function route(string $name, array $vars):string
{
    $prefix = require 'config/view.php';
    $url = '';
    foreach (Router::$controllers as $controller) {
        if ($controller->name === $name) {
            $url = $controller->url;
            break;
        }
    }
    $actual_link = 'http'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 's' : '')."://$_SERVER[HTTP_HOST]";
    return $actual_link.$prefix.Router::bindVarsToBrackets($url,$vars);
}
?>
