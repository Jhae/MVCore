<?php

namespace MVCore\Http\Controller;

use MVCore\Http\{Router, Kernel};

abstract class Controller
{

    public string $url;
    public string $operation;
    public string $httpMethod;
    public ?string $name;
    public $urlVars = [];
    public $middlewares = [];

    function __construct(string $url, string $operation, string $httpMethod, ?string $name)
    {
        $this->url = $url;
        $this->operation = $operation;
        $this->httpMethod = $httpMethod;
        $this->name = $name;
    }

    function view(string $viewName, array $data)
    {

        foreach ($data as $key => $value) {
            ${$key} = $value;
        }
        require 'view/' . $viewName . '.php';
    }

    function index()
    {
        $this->view('indexView', []);
    }

    function hasOperation(): bool
    {
        return method_exists(static::class, $this->operation);
    }

    function launchOperation()
    {
        $operationName = $this->operation;
        $this->$operationName();
    }

    function launchDefaultOperation()
    {
        $operationName = static::DEFAULT_OPERATION;
        $this->$operationName();
    }

    function operationSupportsMethod() : bool
    {
        $supported = false;
        switch ($this->httpMethod) {
            case 'GET':
                $supported = in_array($this->operation, static::GET_OPERATIONS, true);
                break;
            case 'POST':
                $supported = in_array($this->operation, static::POST_OPERATIONS, true);
                break;
            default:
                break;
        }
        return $supported;
    }

    function name(string $name)
    {
        foreach (Router::$controllers as $controller) {
            if ($controller->name === $name) {
                die("<br>El nombre: $name ya ha sido declarado en otra ruta<br>");
                break;
            }
        }
        $this->name = $name;
        return end(Router::$controllers);
    }

    function middleware(string ...$middlewares)
    {
        foreach ($middlewares as $middleware) {
            if (!key_exists($middleware, Kernel::$routeMiddlewares)) {
                $this->middlewares=[];
                die("El middleware ($middleware) no está registrado");
                break;
            }
            $this->middlewares[] = new Kernel::$routeMiddlewares[$middleware];

        }
    }

    public function performMiddlewares()
    {
        $performNextMiddleware = function () use (&$middlewares, &$performNextMiddleware) {
            if (next($this->middlewares) !== false) {
                return current($this->middlewares)->handle($performNextMiddleware);
            }
        };
        if (count($this->middlewares) > 0) current($this->middlewares)->handle($performNextMiddleware);
    }
}
