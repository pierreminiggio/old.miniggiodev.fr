<?php

use App\Database\DatabaseFetcherFactory;
use App\Security\BearerTokenChecker;
use PierreMiniggio\DatabaseConnection\DatabaseConnection;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

BearerTokenChecker::check();

$fetcher = (new DatabaseFetcherFactory())->make(DatabaseConnection::UTF8_MB4);

$requestBody = file_get_contents('php://input');

if (empty($requestBody)) {
    http_response_code(400);
    echo json_encode(['error' => 'Body can\'t be empty']);
    exit;
}

$jsonRequestBody = json_decode($requestBody);
if (empty($jsonRequestBody)) {
    http_response_code(400);
    echo json_encode(['error' => 'Bad JSON body']);
    exit;
}

var_dump($jsonRequestBody);
