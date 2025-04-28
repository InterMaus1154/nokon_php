<?php

use Core\View;

if (!function_exists('dd')) {
    function dd(mixed $data, ?string $message): void
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
    function view(string $name, array $data = []): View
    {
        return View::prepare($name, $data);
    }
}

if (!function_exists('app')) {

    function app(?string $serviceKey): mixed
    {
        if(!isset($serviceKey)){
            return \Core\App::getInstance();
        }
        return \Core\App::getInstance()->getService($serviceKey);
    }
}

if(!function_exists('request')){

    function request(?string $key, mixed $default = null){
        if(!isset($key)){
            return (new \Core\Request\Request());
        }
        return (new \Core\Request\Request())->input($key, $default);
    }
}
