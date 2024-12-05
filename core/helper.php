<?php

use JetBrains\PhpStorm\NoReturn;

if (!function_exists('dd')) {
    #[NoReturn]
    function dd($message, $value = null): void
    {
        echo $message;
        echo "<pre>";
        $value != null ? var_dump($value) : null;
        echo "</pre>";
        die;
    }
}

if (!function_exists('urlIs')) {
    function urlIs($value): bool
    {
        return $_SERVER['REQUEST_URI'] === $value;
    }
}

if (!function_exists('view')) {
    function view($name, $data = [])
    {
        \Core\View::make($name, $data)->show();
    }
}

if (!function_exists('app')) {

    function app(mixed $serviceKey = null): mixed
    {
        $app = \Core\App::getInstance();
        return $app->getService($serviceKey);
    }
}

if (!function_exists('redirect')) {
    function redirect(string $url):void
    {
        app('redirect')->to($url);
    }
}
