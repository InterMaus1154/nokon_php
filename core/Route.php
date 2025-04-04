<?php

namespace core;

use Closure;

class Route
{

    public string $methodName;

    public function __construct(public RequestMethod $method, public string $uri, public mixed $action)
    {
        $this->methodName = $this->method->value;
    }


    /**
     * [WIP] Method
     * @return string
     */
    public function getRouteString(): string
    {
        return strtoupper($this->method->value) . '::' . $this->uri;
    }
}