<?php

use App\Database\DatabaseFetcherFactory;

$authHeader = $_SERVER['HTTP_AUTHORIZATION'];

$config = require
    __DIR__
    . DIRECTORY_SEPARATOR
    . '..'
    . DIRECTORY_SEPARATOR
    . 'config.php'
;
$validToken = $config['apiToken'];

if (! $authHeader || $authHeader !== 'Bearer ' . $validToken) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$fetcher = (new DatabaseFetcherFactory())->make();
var_dump($fetcher);

exit;
