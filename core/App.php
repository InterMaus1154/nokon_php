<?php

namespace core;
use core\helpers\ServiceSingleton;
use core\interfaces\Runnable;
use Exception;

class App extends ServiceSingleton implements Runnable
{
    /**
     * View directory
     */
    public static string $VIEW_DIRECTORY = __DIR__ . '/../views/';

    public static string $SYSTEM_VIEW_DIRECTORY = __DIR__ . '/../core/views/';

    protected static array $appConfiguration = [];

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
        self::$appConfiguration = self::getAppConfigurations();
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
            $values = self::$appConfiguration;
        }
        return $values;
    }

    /**
     * Set an App configuration value
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function setAppConfigurationValue(string $key, mixed $value): void
    {
        self::$appConfiguration[$key] = $value;
    }
}