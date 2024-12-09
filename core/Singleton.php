<?php

namespace Core;

abstract class Singleton
{
    protected function __construct()
    {}

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
}