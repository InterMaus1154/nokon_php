<?php

namespace Core;

abstract class Singleton
{
    protected array $services = array();
    protected function __construct()
    {
    }

    private function __clone(): void
    {}

    private static mixed $instances = [];

    public static function getInstance(): static
    {
        $class = static::class;
        if(!isset(self::$instances[$class])){
            self::$instances[$class] = new static();
        }

        return self::$instances[$class];
    }

    public function with(string $serviceKey, mixed $service):static{
        $this->services[$serviceKey] = $service;
        return self::getInstance();
    }

    /**
     * Get a service instance
     * @param string | null $serviceKey
     * @return mixed
     */
    public function getService(string | null $serviceKey = null): mixed
    {
        // check if service key provided
        if(!isset($serviceKey)){
            return self::getInstance();
        }

        // check if service exists
        if(!$this->isServiceRegistered($serviceKey)){
            die("No registered service with this key!");
        }

        return $this->services[$serviceKey];
    }

    /**
     * Check if a service is registered
     * @param string $serviceKey
     * @return bool
     */
    public function isServiceRegistered(string $serviceKey):bool
    {
        return isset($this->services[$serviceKey]);
    }

    /** Remove an already registered service instance
     * @param string $serviceKey
     * @return void
     */
    public function removeService(string $serviceKey): void
    {
        // check if service exists
        if(!$this->isServiceRegistered($serviceKey)){
            die("No registered service with this key!");
        }

        unset($this->services[$serviceKey]);
    }

    public function __get(string $serviceKey)
    {
        if(!$this->isServiceRegistered($serviceKey)) die("Service not registered $serviceKey");
        return $this->getService($serviceKey);
    }
}