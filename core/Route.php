<?php

namespace Core;

class Route
{
    public static function get(string $uri, callable $action): void
    {
        app('router')->addRoute('GET', $uri, $action);
    }

    public static function post(string $uri, callable $action): void
    {
        app('router')->addRoute('POST', $uri, $action);
    }

    public static function put(string $uri, callable $action): void
    {
        app('router')->addRoute('PUT', $uri, $action);
    }

    public static function patch(string $uri, callable $action): void
    {
        app('router')->addRoute('PATCH', $uri, $action);
    }

    public static function delete(string $uri, callable $action): void
    {
        app('router')->addRoute('DELETE', $uri, $action);
    }
}