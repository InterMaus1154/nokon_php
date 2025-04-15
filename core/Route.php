<?php

namespace core;

use Closure;

class Route
{

    public string $methodName;

    public function __construct(public RequestMethod $method, public string $uri, public array|Renderable|Closure $action)
    {
        $this->methodName = $this->method->value;
    }


    /**
     * [WIP] Method
     * Get unique signature of a route
     * Structure:
     * <REQUEST_METHOD>::<URI>
     * @return string
     */
    public function getRouteSignature(): string
    {
        return self::createRouteSignature($this->methodName, $this->uri);
    }

    public static function createRouteSignature(string $requestMethod, string $uri): string
    {
        return strtoupper($requestMethod) . '::' . $uri;
    }
}