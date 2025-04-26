<?php

namespace Core\Request;

class Request
{

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
        $this->server = $_SERVER;
    }

    /**
     * Returns a value that is submitted either via GET or POST.
     * If not found, returns default if specified
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function input(string $key, mixed $default = null): mixed
    {
        return array_merge($this->get, $this->post)[$key] ?? $default;
    }

    /**
     * Returns a value that is submitted via GET request
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function query(string $key, mixed $default = null): mixed
    {
        return $this->get[$key] ?? $default;
    }

    /**
     * Return an array of GET and POST values
     * @return array
     */
    public function all(): array
    {
        return array_merge($this->get, $this->post) ?? [];
    }

    /**
     * Returns only an array of values specified by key
     * @param string ...$keys
     * @return array
     */
    public function only(string ...$keys): array
    {
        return array_filter($this->all(), function($key) use($keys){
            return in_array($key, $keys);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Returns array of values except provided keys
     * @param string ...$keys
     * @return array
     */
    public function except(string ...$keys): array
    {
        return array_filter($this->all(), function($key)use($keys){
            return !in_array($key, $keys);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Determine whether request has a specified key
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return in_array($key, $this->all());
    }
}