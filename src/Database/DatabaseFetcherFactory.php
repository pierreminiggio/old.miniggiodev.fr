<?php

namespace App\Database;

use PierreMiniggio\DatabaseConnection\DatabaseConnection;
use PierreMiniggio\DatabaseFetcher\DatabaseFetcher;

class DatabaseFetcherFactory
{

    protected static DatabaseFetcher $fetcher;

    public function make(string $charset = DatabaseConnection::UTF8): DatabaseFetcher
    {
        if (! isset(static::$fetcher)) {
            $config = require
                __DIR__
                . DIRECTORY_SEPARATOR
                . '..'
                . DIRECTORY_SEPARATOR
                . '..'
                . DIRECTORY_SEPARATOR
                . 'config.php'
            ;
            $dbConfig = $config['db'];

            static::$fetcher = new DatabaseFetcher(new DatabaseConnection(
                $dbConfig['host'],
                $dbConfig['site-db'],
                $dbConfig['username'],
                $dbConfig['password'],
                $charset
            ));
        }

        return static::$fetcher;
    }
}
