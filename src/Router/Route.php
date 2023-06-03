<?php

namespace App\Router;

class Route implements RouteInterface
{
    private function __construct(){}
    public static array $routes = [];
    public static function get(string $path, string $controller, string $method, array $middlewares = []): void
    {
        self::$routes['GET'][$path] = [
            $controller,
            $method,
            $middlewares
        ];
    }
}