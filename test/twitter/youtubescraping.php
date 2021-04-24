<?php
ini_set('display_errors', 1);
if (PHP_VERSION_ID < 50600) {
    ini_set('mbstring.internal_encoding', 'UTF-8');
} else {
    ini_set('default_charset', 'UTF-8');
}
?>
<head>
    <meta charset="UTF-8">
    <title>Test api</title>
    <style>
    </style>
</head>

<body>
<h1>Test Youtube -> Twitter</h1>
<?php

// Twitter
require_once __DIR__ . DIRECTORY_SEPARATOR . 'fonctions.php';

// BDD
require_once __DIR__ . DIRECTORY_SEPARATOR . 'utils.php';

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

$instantTweet = false;

// Channels I don't want to share videos from
$channelQueryConnection = Utils::connecter();
$channelQuery = "SELECT youtube_id FROM " . $dbConfig['channel-storage-db'] . ".youtube_channel";
$fetchedChannels = Utils::querySQL($channelQuery, $channelQueryConnection)->fetchAll();
Utils::deconnecter($channelQueryConnection);

$excludedChannelIds = [];

if ($fetchedChannels) {
    $excludedChannelIds = array_map(fn ($fetchedChannel) => $fetchedChannel['youtube_id'], $fetchedChannels);
}

// J'ai recup le Refresh Token depuis le Playground :
// https://developers.google.com/oauthplayground

// Je vais récupérer mon Access Token :

$accessTokenCurl = curl_init();
curl_setopt_array($accessTokenCurl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://www.googleapis.com/oauth2/v4/token',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => http_build_query($config['google-api'])
]);
$accessTokenCurlResult = curl_exec($accessTokenCurl);

if ($accessTokenCurlResult === false) {
    echo 'Error curl';
    exit();
}

$accessTokenJsonResponse = json_decode($accessTokenCurlResult);
if (! empty($accessTokenJsonResponse->error)) {
    echo 'Error ' . $accessTokenJsonResponse->error->code . ': ' . $accessTokenJsonResponse->error->message;
    exit();
}

// Je vais récupérer mes vidéos likés sur Youtube :

// On se connecte au lien
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://www.googleapis.com/youtube/v3/videos?myRating=like&part=snippet,status&max_results=50'
]);
$authorization = "Authorization: Bearer " . $accessTokenJsonResponse->access_token;
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json' , $authorization]);

// Et on récupère tout
$result = curl_exec($curl);

$jsonResponse = json_decode($result);
if (! empty($jsonResponse->error)) {
    echo 'Error ' . $jsonResponse->error->code . ': ' . $jsonResponse->error->message;
    exit();
}

$likes = array_reverse($jsonResponse->items);

foreach ($likes as $like) {

    if ($like->status->privacyStatus !== 'public') {
        continue;
    }

    $snippet = $like->snippet;
    $channelId = $snippet->channelId;

    if (in_array($channelId, $excludedChannelIds)) {
        continue;
    }

    $videoId = $like->id;
    $watchVideo = 'https://youtu.be/' . $videoId;
    $title = $snippet->title;
    
 
    // On check si le like est en bdd
    $conn = Utils::connecter();
    $sql = "SELECT * FROM " . $dbConfig['site-db'] . ".social__youtube WHERE youtubeid = " . $conn->quote($videoId) . ";";
    $result = Utils::querySQL($sql, $conn);
    $counter = 0;

    foreach ($result->fetchAll() as $a) {
        $counter++;
    }

    Utils::deconnecter($conn);
    
    // On l'ajoute en BDD et on poste le Tweet
    if ($counter == 0) {

        // On récupère le handle twitter juste avant
        $twitterHandlerCurl = curl_init();
        curl_setopt_array($twitterHandlerCurl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://twitter-handle-finder-api.miniggiodev.fr/' . $channelId
        ]);
        $twitterHandlerResponse = curl_exec($twitterHandlerCurl);

        $twitterHandle = null;

        if ($twitterHandlerResponse) {
            $twitterHandlerJsonResponse = json_decode($twitterHandlerResponse, true);
            $twitterHandle = $twitterHandlerJsonResponse['twitter_handle'] ?? null;
        }

        $conn = Utils::connecter();

        $sql = <<<SQL
            INSERT INTO {$dbConfig['site-db']}.social__youtube (youtubeid, channel_id, created_at)
            VALUES ({$conn->quote($videoId)}, {$conn->quote($channelId)}, NOW());
        SQL;

        Utils::execSQL($sql, $conn);

        Utils::deconnecter($conn);

        // On poste sur Twitter
        $status = "J'ai 👍 la vidéo" . (
            $twitterHandle
                ? (" de @" . $twitterHandle)
                : ''
            ) . ' "' . $title . '" ' . $watchVideo
        ;

        if ($instantTweet) {
            if (! empty(json_decode(updateStatus($status))->created_at)) {
                echo '<br>Tweet posté : ' . $status;
            } else {
                echo '<br>Erreur en tentant de poster : ' . $status;
            }
        } else {
            echo '<br>Tweet que j\'aurais posté si j\'avais pas désactivé les Tweets instant : ' . $status;
        }
    }

    // On met à jour la ligne en BDD
    $conn = Utils::connecter();
    $sql = "SELECT * FROM " . $dbConfig['site-db'] . ".social__youtube WHERE youtubeid =" . $conn->quote($videoId) . ";";
    $result = Utils::querySQL($sql, $conn);
    $databaseLines = $result->fetchAll();
    Utils::deconnecter($conn);

    foreach ($databaseLines as $line) {
        $conn = Utils::connecter();
        $sql = "UPDATE "
            . $dbConfig['site-db']
            . ".social__youtube SET title = "
            . $conn->quote($title)
            . ", updated_at = NOW() WHERE id = "
            . $line['id']
            . ";"
        ;
        Utils::execSQL($sql, $conn);
        Utils::deconnecter($conn);
    }
}

?><br>Import fini
</body>
<?php
exit();
