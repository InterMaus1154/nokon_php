<?php


namespace core\helpers;
use core\interfaces\Runnable;
use Exception;

abstract class ServiceSingleton implements Runnable
{
    protected function __construct()
    {}

    private function __clone(): void
    {}

    private static mixed $instances = [];
    protected array $services = array();

    public static function getInstance(): static
    {
        $class = static::class;
        if(!isset(self::$instances[$class])){
            self::$instances[$class] = new static();
        }
        return self::$instances[$class];
    }

    /**
     *
     * @param string $serviceKey
     * @param mixed $service
     * @return $this
     * @throws Exception
     */
    public function with(string $serviceKey, mixed $service):static{
        $this->registerService($serviceKey, $service);
        return self::getInstance();
    }

    /**
     * Get a service instance
     * @param string $serviceKey
     * @return mixed
     * @throws Exception
     */
    public function getService(string $serviceKey): mixed
    {
        // check if service exists
        if(!$this->isServiceRegistered($serviceKey)){
            throw new Exception("No registered service with this key!");
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
     * @throws Exception
     */
    public function removeService(string $serviceKey): void
    {
        // check if service exists
        if(!$this->isServiceRegistered($serviceKey)){
            throw new Exception("No registered service with this key!");
        }
        unset($this->services[$serviceKey]);
    }

    /**
     * Register a service to the app
     * @param string $serviceKey
     * @param mixed $service
     * @return void
     * @throws Exception
     */
    public function registerService(string $serviceKey, mixed $service): void
    {
        // check for duplicate
        if(isset($this->services[$serviceKey])){
            throw new Exception('Service already registered!');
        }

        $this->services[$serviceKey] = $service;
    }

    /**
     * @throws Exception
     */
    public function __get(string $serviceKey)
    {
        if(!$this->isServiceRegistered($serviceKey)){
            throw new Exception("Service not registered $serviceKey");
        }
        return $this->getService($serviceKey);
    }
}