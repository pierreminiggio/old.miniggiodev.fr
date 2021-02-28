<?php

namespace App;

class ConfigProvider
{

    protected static array $config;

    public static function get(): array
    {
        if (! isset(static::$config)) {
            static::$config = require
                __DIR__
                . DIRECTORY_SEPARATOR
                . '..'
                . DIRECTORY_SEPARATOR
                . 'config.php'
            ;
        }

        return static::$config;
    }
}
