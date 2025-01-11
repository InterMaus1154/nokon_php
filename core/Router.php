<?php

namespace Core;

use Core\ReturnTypes;

class Router extends Singleton
{
    private function test()
    {
    }

    protected function __construct()
    {
        parent::__construct();
    }

    public static array $routes = [];

    public function addRoute(string $method, string $uri, callable $action): void
    {
        self::$routes[] = [
            'method' => $method,
            'uri' => $uri,
            'action' => $action
        ];
    }

    /**
     * @return void
     */
    public function dispatch(): void
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            if ($route['method'] === $requestMethod && $route['uri'] === $requestUri) {
                $action = $route['action'];
                try{
                    $reflection = new \ReflectionFunction($action);
                }catch (\ReflectionException $e){
                    die($e->getMessage());
                }
                switch ($reflection->getReturnType()?->getName()){
                    case ReturnTypes::VIEW->value:
                        $reflection->invoke()->show();
                        break;
                    case ReturnTypes::RESPONSE->value:
                        $reflection->invoke();
                        break;
                }
            }
        }
        http_response_code(404);
    }
}