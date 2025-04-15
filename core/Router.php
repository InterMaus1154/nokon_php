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
        // parse uri and method from the request
        $requestUri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // create route signature
        $requestedRouteSignature = Route::createRouteSignature($requestMethod, $requestUri);

        // if requested page is not found (route not registered), set 404
        // proper exception TODO
        if(!$routeStorage->isRouteRegistered($requestedRouteSignature)){
            http_response_code(404);
            echo "404: Page not found";
            exit;
        }

        $route = $routeStorage->getRoutes()[$requestedRouteSignature];
        $action = $route->action;
        if(is_array($action)){
            [$class, $method]= $action;
            $instance = new $class();
            $result = $instance->$method();
            if($result instanceof Renderable){
                $result->render();
            }
            exit;
        }
        $result = $action();
        if($result instanceof Renderable){
                $result->render();
        }

    }
}