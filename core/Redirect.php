<?php

namespace Core;

class Redirect extends Singleton
{
    protected function __construct()
    {
        parent::__construct();
    }

    /**
     * Redirect to a specific url
     * @param string $url
     * @param int $status
     * @param bool $replace
     * @return Redirect
     */
    public static function to(string $url, int $status = 302, bool $replace = true): Redirect
    {
        header("Location: {$url}", $replace, $status);
        return self::getInstance();
    }

    /**
     * @return Redirect
     */
    public static function back(): Redirect
    {
        if ($_SERVER['HTTP_REFERER']) {
            return self::to($_SERVER['HTTP_REFERER']);
        }
        return self::to('/');
    }

    public static function withMessage(string $key, mixed $data): Redirect
    {
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
        $_SESSION[$key] = $data;
        return self::getInstance();
    }

}