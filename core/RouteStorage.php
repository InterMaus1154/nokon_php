<?php

namespace core;

use Closure;

class RouteStorage
{
    /**
     * @var Route[]
     */
    private array $routes = [];

    /**
     * Registers a new route
     * @param RequestMethod $method
     * @param string $uri
     * @param array|Closure|Renderable $action
     * @return void
     */
    public function route(RequestMethod $method, string $uri, array|Closure|Renderable $action): void{
        $route = new Route(method: $method, uri: $uri, action: $action);

        // check if route signature is already registered
        // prevent duplicate routes
        if(isset($this->routes[$route->getRouteSignature()])){
            die("Route ".$route->getRouteSignature()." is already registered!");
        }

        // add the route object to the array
        $this->routes[$route->getRouteSignature()] = $route;
    }

    /**
     * Registers a route with GET method
     * @param string $uri
     * @param array|Closure|Renderable $action
     * @return void
     */
    public function get(string $uri, array|Closure|Renderable $action): void{
        $this->route(RequestMethod::GET, $uri, $action);
    }

    /**
     * Registers a route with POST method
     * @param string $uri
     * @param array|Closure|Renderable $action
     * @return void
     */
    public function post(string $uri, array|Closure|Renderable $action): void{
        $this->route(RequestMethod::POST, $uri, $action);
    }

    /**
     * Registers a route with PUT method
     * @param string $uri
     * @param array|Closure|Renderable $action
     * @return void
     */
    public function put(string $uri, array|Closure|Renderable $action): void
    {
        $this->route(RequestMethod::PUT, $uri, $action);
    }

    /**
     * Registers a route with DELETE method
     * @param string $uri
     * @param array|Closure|Renderable $action
     * @return void
     */
    public function delete(string $uri, array|Closure|Renderable $action): void
    {
        $this->route(RequestMethod::DELETE, $uri, $action);
    }

    /**
     * Registers a route with PATCH method
     * @param string $uri
     * @param array|Closure|Renderable $action
     * @return void
     */
    public function patch(string $uri, array|Closure|Renderable $action): void
    {
        $this->route(RequestMethod::PATCH, $uri, $action);
    }

    /**
     * Returns TRUE or FALSE if a route is registered based on route signature
     * @param string $routeSignature
     * @return bool
     */
    public function isRouteRegistered(string $routeSignature): bool
    {
        return isset($this->routes[$routeSignature]);
    }

    /**
     * Return the array of registered routes
     * @return Route[]
     */
    public function getRoutes():array{
        return $this->routes;
    }
}