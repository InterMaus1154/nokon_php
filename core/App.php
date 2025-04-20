<?php

namespace Core;
require "Singleton.php";
use Core\Singleton;

class App extends Singleton
{
    /**
     * View directory
     */
    public static string $VIEW_DIRECTORY = __DIR__ . '/../views/';

    public static string $SYSTEM_VIEW_DIRECTORY = __DIR__ . '/../core/views/';

    /**
     * Change the directory used to resolve views
     * Default: root/views
     * @param string $viewDirectory
     * @return void
     */
    public function setViewDirectory(string $viewDirectory): void
    {
        self::$VIEW_DIRECTORY = $viewDirectory;
    }

    /**
     * Register a service to the app
     * @param string $serviceKey
     * @param mixed $service
     * @return void
     */
    public function registerService(string $serviceKey, mixed $service): void
    {
        // check for duplicate
        if(isset($this->services[$serviceKey])){
            die("Service already registered");
        }

        $this->services[$serviceKey] = $service;
    }

    /**
     * @return void
     * Run the application
     */
    public function run(RouteStorage $routeStorage): void
    {
        if(!$this->isServiceRegistered('router')){
            http_response_code(500);
            die("Router not found");
        }

//        if(!$this->isServiceRegistered('nokonExceptionHandler')){
//            http_response_code(500);
//            die("Default exception handler is not found");
//        }

        // TODO: create proper exception handling
//        set_exception_handler([$this->getService('nokonExceptionHandler'), 'handleException']);

        $this->router
            ->with('routeStorage', $routeStorage)
            ->dispatch();
    }
}