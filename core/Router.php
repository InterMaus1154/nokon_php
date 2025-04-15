<?php

namespace Core;

use Closure;
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
     * @param RouteStorage $routeStorage
     * @return void
     */
    public function dispatch(RouteStorage $routeStorage): void
    {
//        print_r($routeStorage->getRoutes()['GET::/']->action);
        $route = $routeStorage->getRoutes()['GET::/'];
        $action = $route->action;
        $result = $action();
        if($result instanceof Renderable){
//            $result->render();
        }

        $requestUri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $requestedRouteSignature = Route::createRouteSignature($requestMethod, $requestUri);
        if(!$routeStorage->isRouteRegistered($requestedRouteSignature)){
            http_response_code(404);
            echo "404: Page not found";
            exit;
        }
        exit;
        // print_r($this->user[$requestMethod][$requestUri]());

        if (!$this->isRouteExist($requestMethod, $requestUri)) {
            http_response_code(404);
            echo "404: Route not found!";
            exit;
        }

        $action = $this->routes[$requestMethod][$requestUri]();
        $action->render();

    }
}