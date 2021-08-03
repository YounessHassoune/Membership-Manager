<?php

namespace App\route;

use App\http\Exceptions;
use App\http\Request;
use App\http\Response;

class Route
{
    protected static $routes = [];
    public function __construct(object $RequestInfo)
    {
        $this->RequestInfo = $RequestInfo;
    }
    public static function get($path, $callback)
    {
        self::$routes['GET'][$path] = $callback;
    }
    public static function post($path, $callback)
    {
        self::$routes['POST'][$path] = $callback;
    }
    public static function getRoutes(): array
    {
        return self::$routes;
    }
    public function resolver()
    {
        $path = $this->RequestInfo->path;
        $method = $this->RequestInfo->method;
        $callback = self::$routes[$method][$path] ?? false;
        if ($callback === false) {
            return  Response::json(Exceptions::HttpNotFoundException());
        }
        return call_user_func($callback, new Request(), new Response());
    }
}
