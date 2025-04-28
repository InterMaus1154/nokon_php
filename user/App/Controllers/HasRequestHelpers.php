<?php

namespace User\App\Controllers;

use Core\Request\Request;

trait HasRequestHelpers
{
//    protected function __init(): void
//    {
//        $this->request = new Request();
//    }

    protected function query(string $key, mixed $default = null): mixed
    {
        return $this->request->query($key, $default);
    }

    protected function input(string $key, mixed $default = null): mixed
    {
        return $this->request->input($key, $default);
    }

    protected function all(): array
    {
        return $this->request->all();
    }

    protected function only(string ...$keys): array
    {
        return $this->request->only(...$keys);
    }

    protected function except(string ...$keys): array
    {
        return $this->request->except(...$keys);
    }

    protected function has(string $key): bool
    {
        return $this->request->has($key);
    }

    protected function isEmpty(): bool
    {
        return $this->request->isEmpty();
    }

}