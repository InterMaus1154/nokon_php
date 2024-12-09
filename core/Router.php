<?php

namespace Core;

use Core\Singleton;

class Router extends Singleton
{
    protected function __construct(){}

    public static $routes = [];

    public function addRoute(string $method, string $uri, callable $action): void
    {
        self::$routes[] = [
            'method' => $method,
            'uri' => $uri,
            'action' => $action
        ];
    }

    public function dispatch(): void
    {
        $requestUri =  parse_url($_SERVER['REQUEST_URI'])['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route){
            if($route['method'] === $requestMethod && $route['uri'] === $requestUri){
                if(is_callable($route['action'])){
                    call_user_func($route['action']);
                    return;
                }
            }
        }
        http_response_code(404);
        die("Page not found!");
    }
}