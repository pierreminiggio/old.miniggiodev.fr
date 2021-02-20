<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'fonctions.php');

$authHeader = $_SERVER['HTTP_AUTHORIZATION'];

$config = require
            __DIR__
            . DIRECTORY_SEPARATOR
            . '..'
            . DIRECTORY_SEPARATOR
            . '..'
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

$requestBody = file_get_contents('php://input');

if (empty($requestBody)) {
    http_response_code(400);
    echo json_encode(['error' => 'Body can\'t be empty']);
    exit;
}

$twitterResponse = json_decode(updateStatus($requestBody));

if (! isset($twitterResponse->id)) {
    http_response_code(500);
    echo json_encode(['error' => isset($twitterResponse->errors) ? $twitterResponse->errors : 'Internal Error']);
    exit;
}

http_response_code(200);
echo json_encode(['id' => $twitterResponse->id]);
exit;
