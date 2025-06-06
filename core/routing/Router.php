<?php

namespace Core\Routing;

use Core\helpers\ServiceSingleton;
use Core\interfaces\Renderable;
use Exception;

class Router extends ServiceSingleton
{
    protected function __construct()
    {
        parent::__construct();
    }

    /**
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        // parse uri and method from the request
        $requestUri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // create route signature
        $requestedRouteSignature = Route::createRouteSignature($requestMethod, $requestUri);

        // if requested page is not found (route not registered), set 404
        // proper exception TODO
        if (!$this->routeStorage->isRouteRegistered($requestedRouteSignature)) {
            http_response_code(404);
            throw new Exception('Page not found!');
        }

        $route = $this->routeStorage->getRoutes()[$requestedRouteSignature];
        $action = $route->action;
        if (is_array($action)) {
            [$class, $method] = $action;
            $instance = new $class();
            $result = $instance->$method();
        }else{
            $result = $action();
        }
        if ($result instanceof Renderable) {
            $result->render();
        }

    }
}