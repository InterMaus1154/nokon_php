<?php

namespace User\App\Controllers;
use Core\Request\Request;

trait HasRequestHelpers{
    protected function query(string $key, mixed $default = null): mixed
    {
        return (new Request)->query($key, $default);
    }

    protected function input(string $key, mixed $default = null): mixed
    {
        return (new Request)->input($key, $default);
    }

    protected function all(): array
    {
        return (new Request)->all();
    }
}