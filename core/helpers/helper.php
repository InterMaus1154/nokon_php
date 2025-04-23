<?php

use Core\View;

if (!function_exists('dd')) {
    function dd(mixed $data, string|null $message = null): void
    {
        echo "<pre>";
        $data != null ? var_dump($data) : null;
        echo "</pre>";
        die($message ?? null);
    }
}

if (!function_exists('urlIs')) {
    function urlIs($value): bool
    {
        return $_SERVER['REQUEST_URI'] === $value;
    }
}

if (!function_exists('view')) {
    function view($name, $data = []): View
    {
        return View::prepare($name, $data);
    }
}

if (!function_exists('app')) {

    function app(string $serviceKey = null): mixed
    {
        if(!isset($serviceKey)){
            return \Core\App::getInstance();
        }
        return \Core\App::getInstance()->getService($serviceKey);
    }
}
