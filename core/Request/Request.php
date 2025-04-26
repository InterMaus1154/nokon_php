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
        return array_merge($this->get, $this->post);
    }
}