<?php

namespace App\Router;

interface RouteInterface
{
    public static function get(string $path, string $controller, string $method, array $middlewares = []);

}