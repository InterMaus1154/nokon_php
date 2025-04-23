<?php

namespace Core;
use Core\Helpers\ServiceSingleton;
use Core\Interfaces\Runnable;
use Exception;

class App extends ServiceSingleton implements Runnable
{
    /**
     * View directory
     */
    public static string $VIEW_DIRECTORY = __DIR__ . '/../Views/';

    public static string $SYSTEM_VIEW_DIRECTORY = __DIR__ . '/../core/views/';

    protected static array $appConfigurations = [];

    /**
     * Change the directory used to resolve Views
     * Default: root/Views
     * @param string $viewDirectory
     * @return void
     */
    public function setViewDirectory(string $viewDirectory): void
    {
        self::$appConfigurations['view_directory'] = $viewDirectory;
    }

    /**
     * @return void
     * Run the application
     * @throws Exception
     */
    public function run(): void
    {
        self::$appConfigurations = self::getAppConfigurations();
        if(!$this->isServiceRegistered('router')){
            http_response_code(500);
            throw new Exception('Router not found');
        }

        $this->router
            ->with('routeStorage', $this->routeStorage)
            ->run();
    }

    /**
     * Returns an array of App configurations defined in 'app_config.php'
     * @return array
     */
    public static function getAppConfigurations(): array
    {
        $values = require_once 'app_config.php';
        if(is_bool($values)){
            $values = self::$appConfigurations;
        }
        return $values;
    }

    /**
     * Set an App configuration value.
     * app_config.php will NOT change, only internal configuration array
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function setAppConfigurationValue(string $key, mixed $value): void
    {
        self::$appConfigurations[$key] = $value;
    }

    /**
     * Reset configuration values to app_config.php
     * @return void
     */
    public static function resetAppConfigurations():void
    {
        self::$appConfigurations = require 'app_config.php';
    }
}