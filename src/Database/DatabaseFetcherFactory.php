<?php

namespace App\Database;

use App\ConfigProvider;
use PierreMiniggio\DatabaseConnection\DatabaseConnection;
use PierreMiniggio\DatabaseFetcher\DatabaseFetcher;

class DatabaseFetcherFactory
{

    protected static DatabaseFetcher $fetcher;

    public function make(string $charset = DatabaseConnection::UTF8): DatabaseFetcher
    {
        if (! isset(static::$fetcher)) {
            $config = ConfigProvider::get();
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
