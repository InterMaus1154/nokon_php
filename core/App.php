<?php

namespace core;
use core\interfaces\Runnable;
use Exception;

require_once "ServiceSingleton.php";

class App extends ServiceSingleton implements Runnable
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
     * @return void
     * Run the application
     * @throws Exception
     */
    public function run(): void
    {
        if(!$this->isServiceRegistered('router')){
            http_response_code(500);
            throw new Exception('Router not found');
        }

        $this->router
            ->with('routeStorage', $this->routeStorage)
            ->run();
    }
}