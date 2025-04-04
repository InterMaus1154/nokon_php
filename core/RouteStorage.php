<?php

namespace core;

class RouteStorage
{
    /**
     * @var Route[]
     */
    private array $routes = [];
    public function route(RequestMethod $method, string $uri, callable $action): void{
        $this->routes[] = new Route(method: $method, uri: $uri, action: $action);
    }

    public function getRoutes():array{
        return $this->routes;
    }
}