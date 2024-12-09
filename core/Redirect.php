<?php

namespace Core;
use Core\Singleton;
class Redirect extends Singleton
{
    protected function __construct()
    {
    }

    /**
     * Redirect to a specific url
     * @param string $url
     * @return Redirect
     */
    public static function to(string $url): Redirect
    {
        header("Location: {$url}", true, 302);
        return self::getInstance();
    }

}