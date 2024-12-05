<?php

namespace Core;
use Core\Singleton;
class Redirect extends Singleton
{
    protected function __construct()
    {
    }

    public static function to($url): void
    {
        header("Location: {$url}", true, 302);
    }
}