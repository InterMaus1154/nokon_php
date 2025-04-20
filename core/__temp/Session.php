<?php

namespace core\__temp;

use core\helpers\ServiceSingleton;

class Session extends ServiceSingleton
{
    private static function isSessionActive(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    protected function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns value from session, returns default value if none found
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        if(!self::isSessionActive()){
            session_start();
        }

        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }

        return $default;
    }

    /**
     * Puts data into the session
     * @param string $key
     * @param mixed $data
     * @return void
     */
    public static function put(string $key, mixed $data): void
    {
        if(!self::isSessionActive()){
            session_start();
        }

        $_SESSION[$key] = $data;
    }

    /**
     * Deletes all session values
     * @return void
     */
    public static function flush(): void
    {
        if(!self::isSessionActive()){
            session_start();
        }

        foreach ($_SESSION as $sessionKey => $sessionValue){
            unset($_SESSION[$sessionKey]);
        }
    }

    /**
     * Removes value - if it exists - from the session
     * @param string $key
     * @return void
     */
    public static function remove(string $key): void
    {
        if(!self::isSessionActive()){
            session_start();
        }

        unset($_SESSION[$key]);
    }

}