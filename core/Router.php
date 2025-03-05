<?php

namespace Core;

use Core\ReturnTypes;

class Router extends Singleton
{

    private array $routes = array();

    protected function __construct()
    {
        parent::__construct();
        $this->routes = [];
    }

    private function isRouteExist(string $method, string $uri): bool
    {
        return array_key_exists($method, $this->routes) && array_key_exists($uri, $this->routes[$method]);
    }

    public function addRoute(string $method, string $uri, callable $action): void
    {
        $this->routes[$method][$uri] = $action;
    }

    /**
     * @return void
     */
    public function dispatch(): void
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // print_r($this->routes[$requestMethod][$requestUri]());

        if (!$this->isRouteExist($requestMethod, $requestUri)) {
            http_response_code(404);
            echo "404: Route not found!";
            exit;
        }

        $action = $this->routes[$requestMethod][$requestUri]();
        $action->render();

    }
}