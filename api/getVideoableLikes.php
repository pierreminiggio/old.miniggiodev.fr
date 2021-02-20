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

$likes = $fetcher->query(
    $fetcher
        ->createQuery('social__youtube')
        ->select('id', 'youtubeid as youtube_id', 'title', 'channel_id')
        ->where('channel_id IS NOT NULL AND videoed_at IS NULL')
)
var_dump($likes);
exit;
