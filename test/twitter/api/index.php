<?php

use PierreMiniggio\TwitterHelpers\TwitterPoster;

$currentDirectory = __DIR__ . DIRECTORY_SEPARATOR;

$version = 2;

if ($version === 1) {
    require_once($currentDirectory . '..' . DIRECTORY_SEPARATOR . 'fonctions.php');
} elseif ($version === 2) {
    require $currentDirectory . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
}

$authHeader = $_SERVER['HTTP_AUTHORIZATION'];

$config = require
    $currentDirectory
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

if ($version === 1) {
    $twitterResponse = json_decode(updateStatus($requestBody));

    if (! isset($twitterResponse->id)) {
        http_response_code(500);
        echo json_encode(['error' => isset($twitterResponse->errors) ? $twitterResponse->errors : 'Internal Error']);
        exit;
    }

    http_response_code(200);
    echo json_encode(['id' => $twitterResponse->id]);
    exit;
} elseif ($version === 2) {
    $checkConfig = function (array $config, string $key): mixed {
        if (! isset($config[$key])) {
            http_response_code(500);
            echo json_encode(['error' => 'Bad config : Missing "' . $key . '" key in config']);
            exit;
        }

        return $config[$key];
    };

    $twitterApiConfig = $checkConfig($config, 'twitter-api');
    $pierreMiniggioConfig = $checkConfig($twitterApiConfig, 'pierreminiggio');

    $consumerKey = $checkConfig($pierreMiniggioConfig, 'consumer_key');
    $consumerSecret = $checkConfig($pierreMiniggioConfig, 'consumer_secret');
    $accessToken = $checkConfig($pierreMiniggioConfig, 'oauth_access_token');
    $accessTokenSecret = $checkConfig($pierreMiniggioConfig, 'oauth_access_token_secret');

    $twitter = new TwitterPoster($accessToken, $accessTokenSecret, $consumerKey, $consumerSecret);

    $status = json_decode($twitter->updateStatus($requestBody, TwitterPoster::VERSION_2));

    if (! isset($status->id)) {
        http_response_code(500);
        echo json_encode(['error' => 'Missing "id" key in Twitter reponse']);
        exit;
    }

    http_response_code(200);
    echo json_encode(['id' => $status->id]);
    exit;
}
