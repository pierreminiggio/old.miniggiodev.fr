<?php

use App\Database\DatabaseFetcherFactory;

$authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;

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

$likes = array_map(fn (array $entry) => [
    'id' => (int) $entry['id'],
    'title' => $entry['title'],
    'youtube_id' => $entry['youtubeid'],
    'channel_id' => $entry['channel_id']
] ,$fetcher->query(
    $fetcher
        ->createQuery('social__youtube')
        ->select('id', 'youtubeid', 'title', 'channel_id')
        ->where('channel_id IS NOT NULL AND videoed_at IS NULL')
        ->orderBy('created_at')
));

$channelInfos = [];

foreach ($likes as &$like) {
    $channelId = $like['channel_id'];
    if (! in_array($channelId, array_keys($channelInfos))) {
        $infos = [];
        
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://youtube-channel-infos-api.miniggiodev.fr/' . $channelId
        ]);

        $result = curl_exec($curl);

        if (! empty($result)) {
            $jsonResult = json_decode($result, true);
            if (! empty($jsonResult)) {
                $infos = $jsonResult;
            }
        }

        $channelInfos[$channelId] = $infos;
    }

    $channelInfos = $channelInfos[$channelId];
    $like['channel_name'] = ! empty($channelInfos) && ! empty($channelInfos['title']) ? $channelInfos['title'] : null;
    $like['channel_country'] = ! empty($channelInfos) && ! empty($channelInfos['country']) ? $channelInfos['country'] : null;
    $like['channel_photo'] = ! empty($channelInfos) && ! empty($channelInfos['photo']) ? $channelInfos['photo'] : null;
}

http_response_code(200);
echo json_encode($likes);
exit;
