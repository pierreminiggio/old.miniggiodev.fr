<?php

use App\Database\DatabaseFetcherFactory;
use App\Query\ChannelInfosQuery;
use App\Security\BearerTokenChecker;
use PierreMiniggio\DatabaseConnection\DatabaseConnection;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

BearerTokenChecker::check();

$fetcher = (new DatabaseFetcherFactory())->make(DatabaseConnection::UTF8_MB4);

$today = new DateTime();

$likes = array_map(fn (array $entry) => [
    'id' => (int) $entry['id'],
    'title' => $entry['title'],
    'youtube_id' => $entry['youtubeid'],
    'channel_id' => $entry['channel_id']
] ,$fetcher->query(
    $fetcher
        ->createQuery('social__youtube')
        ->select('id', 'youtubeid', 'title', 'channel_id')
        ->where('channel_id IS NOT NULL AND videoed_at IS NULL AND created_at < :today_at_midnight')
        ->orderBy('created_at')
        ->limit(30)
    ,
    ['today_at_midnight' => $today->format('Y-m-d') . ' 00:00:00']
));

$channelInfos = [];
$channelInfosQuery = new ChannelInfosQuery();

foreach ($likes as &$like) {
    $channelId = $like['channel_id'];
    if ($channelId && ! in_array($channelId, array_keys($channelInfos))) {
        try {
            $infos = $channelInfosQuery->execute($channelId);
        } catch (Exception) {
            $infos = null;
        }

        $channelInfos[$channelId] = $infos;
    }

    $infos = $channelInfos[$channelId];
    $like['channel_name'] = ! empty($infos) && ! empty($infos['title']) ? $infos['title'] : null;
    $like['channel_country'] = ! empty($infos) && ! empty($infos['country']) ? $infos['country'] : null;
    $like['channel_photo'] = ! empty($infos) && ! empty($infos['photo']) ? $infos['photo'] : null;
}

http_response_code(200);
echo json_encode($likes);
exit;
