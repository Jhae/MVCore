<?php

namespace MVCore\Http;
class Router
{
    static array $controllers = [];

#Declara una ruta  con el método GET
    static function get(string $url, string $controllerAndOperation)
    {
        $method = 'GET';
        self::addController($url, $controllerAndOperation, $method);
        return end(self::$controllers);
    }

#Declara una ruta  con el método POST
    static function post(string $url, string $controllerAndOperation)
    {
        $method = 'POST';
        self::addController($url, $controllerAndOperation, $method);
        return end(self::$controllers);
    }

#Asocia la ruta declarada a un controlador
    static function addController(string $url, string $controllerAndOperation, string $httpMethod)
    {
        //$formatedUrl = '/?controller=' . explode('/', $url)[1] . '&operation=' . explode('/', $url)[2];
        foreach (Router::$controllers as $declaredController) {
            if ($declaredController->url === $url) {
                die('Existen rutas declaradas maś de una vez');
                break;
            }
        }
        $aux = explode('@', $controllerAndOperation);
        $controllerName = 'MVCore\Http\Controller\\' . $aux[0];
        $operation = $aux[1];
        if (self::controllerExists($controllerName)) {
            $controller = new $controllerName($url, $operation, $httpMethod, null);

            if ($controller->hasOperation() /* && $controller->operationSupportsMethod() */) {
                self::$controllers[] = $controller;
            }
        } else {
            $exception = new \Exception('Controllador no existe');
            echo $exception->getMessage();
        }
    }

#Verifica si existe un controlador existe dado su nombre de clase
    static function controllerExists(string $controllerName)
    {
        return class_exists($controllerName);
    }

#Retorna la ruta absoluta dado una ruta relativa;
    static function url($url)
    {
        $prefix = require 'config/view.php';
        return $prefix . $url;
    }

#Retorna la ruta absoluta dado el nombre de una ruta relativa declarada;
    static function route(string $name)
    {
        $prefix = require 'config/view.php';
        $url = '';
        foreach (Router::$controllers as $controller) {
            if ($controller->name === $name) {
                $url = $controller->url;
                break;
            }
        }
        return $prefix . $url;
    }

#Redirecciona dado el nombre de una ruta relativa declarada
    static function redirectToRoute(string $name, array $vars = [])
    {
        $actual_link = 'http'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 's' : '')."://$_SERVER[HTTP_HOST]";
        $prefix = require 'config/view.php';
        $url = '';
        foreach (Router::$controllers as $controller) {
            if ($controller->name === $name) {
                $url = $controller->name;
            }
        }
        $url = Router::bindVarsToBrackets($url, $vars);
        header("Location: $actual_link$prefix$url");
        exit;
    }

#Redirecciona dada una la ruta relativa
    static function redirect(string $url)
    {
        $actual_link = 'http'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 's' : '')."://$_SERVER[HTTP_HOST]";
        $prefix = require 'config/view.php';
        header("Location: $actual_link$prefix$url");
        exit;
    }

#Revisa y obtine las variables enviadas por URL y los parámetros y las asgina al controlador.
    static function bindVarsToBrackets(string $route, array $vars)
    {
        $routeParts = explode('/', $route);
        $bracketVars = preg_grep('/{[a-zA-Z0-9]*}/', $routeParts);
        foreach ($bracketVars as $varIndex => $varValue) {
            $bracketVarName = str_replace('{', '', str_replace('}', '', $varValue));
            $routeParts[$varIndex] = $vars[$bracketVarName];
            unset($vars[$bracketVarName]);
        }
        $formatedRoute = implode('/', $routeParts);
        if (count($vars) > 0) $formatedRoute .= '?' . http_build_query($vars);
        return $formatedRoute;
    }
#Analiza y asocia la URL dada a una ruta declarada en "routes/web.php"
    static function parseURL(string $requestUri)
    {
        $prefix = require 'config/view.php';
        $urlWithParams = str_replace($prefix, '', $requestUri);
        $url = explode('?', $urlWithParams)[0];
        $urlParts = null;
        $controller = null;
        foreach (Router::$controllers as $declaredController) {
            if ($declaredController->httpMethod === $_SERVER['REQUEST_METHOD']) {
                #Primer método
                if ($url === $declaredController->url) {
                    $controller = $declaredController;
                    break;
                } #Segundo método
                else {
                    if ($controller === null) {
                        #Preparación de rutas para la comparación
                        if ($urlParts === null) $urlParts = explode('/', $url);
                        $urlVars = [];
                        $routeParts = explode('/', $declaredController->url);
                        #Verificación de existencia de variables en la ruta declaradas "{variable}"
                        $bracketVarIndexes = preg_grep('/{[a-zA-Z0-9]*}/', $routeParts);
                        if (count($urlParts) === count($routeParts) && count($bracketVarIndexes) > 0) {
                            #Recorrido de la ruta declarada
                            foreach ($routeParts as $position => $word) {
                                //if (strpos($word, '{') === 0 && strpos($word, '}') === strlen($word)-1)
                                if (array_key_exists($position, $bracketVarIndexes)) {
                                    $bracketVarName = str_replace('{', '', str_replace('}', '', $word));
                                    $urlVars[$bracketVarName] = $urlParts[$position];
                                } elseif ($word !== $urlParts[$position]) {
                                    $urlVars = [];
                                    break;
                                } else continue;
                                if ($position === count($routeParts) - 1) {
                                    $controller = $declaredController;
                                    $declaredController->urlVars = $urlVars;

                                }
                            }
                        }
                    } else break;
                }
            }
        }
        return $controller;
    }
}
