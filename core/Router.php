<?php

namespace Core;

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
     * @return Response
     */
    public function dispatch(): Response
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            if ($route['method'] === $requestMethod && $route['uri'] === $requestUri) {
                $action = $route['action'];
                if (is_callable($action)) {
                    $result = call_user_func($action);
                    if (!($action instanceof Response)) {
                        http_response_code(406);
                        $seenType = gettype($result);
                        session()->put('app_500_error_data_internal', "[406] Path {$requestUri} must return Core\Response, but '$seenType' given");
                        die;
                    }
                    return $result;
                }

            }
        }
        http_response_code(404);
        die("Page not found!");
    }
}