<?php

use Core\View;
use JetBrains\PhpStorm\NoReturn;

if (!function_exists('dd')) {
    #[NoReturn]
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

    function app(mixed $serviceKey = null): mixed
    {
        $app = \Core\App::getInstance();
        return $app->getService($serviceKey);
    }
}

if (!function_exists('redirect')) {
    function redirect(string|null $url = null, int $status = 302, bool $replace = true): \core\__temp\Redirect
    {
        if (!isset($url)) {
            return app('redirect');
        }
        return app('redirect')->to($url, $status, $replace);
    }
}


if (!function_exists('session')) {

    function session(string $key = null, mixed $default = null)
    {
        if (isset($key)) {
            return app('session')->get($key, $default);
        }

        return app('session');
    }
}

if (!function_exists('response')) {
    function response(): \core\__temp\Response
    {
        return \core\__temp\Response::getInstance();
    }
}