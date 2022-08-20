<?php

use App\Database\DatabaseFetcherFactory;
use App\Query\ChannelInfosQuery;
use App\Security\BearerTokenChecker;
use PierreMiniggio\DatabaseConnection\DatabaseConnection;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

BearerTokenChecker::check();

$fetcher = (new DatabaseFetcherFactory())->make(DatabaseConnection::UTF8_MB4);

$today = new DateTime();

$offset = $_GET['offset'] ?? null;

$select = [
    'id_publication_source as status_id',
    'in_reply_to_status_id as in_reply_to_status_id',
    'texte_brut',
    'texte_html',
    'date_publication'
];

$query = $fetcher->createQuery(
    'social__publication'
)->select(
    ...$select
)->orderBy(
    'id_publication_source'
)->limit(
    20
);
$queryParams = [];

if ($offset) {
    $query = $query->where('id_publication_source > :status_id');
    $queryParams['status_id'] = $offset;
}

$findTweet = function (string $statusId) use ($fetcher, $select): ?array {
    $fetchedTweets = $fetcher->query(
        $fetcher->createQuery(
            'social__publication'
        )->select(
            ...$select
        )->where(
            'id_publication_source = :status_id'
        )->limit(
            1
        ),
        ['status_id' => $statusId]
    );

    if (! $fetchedTweets) {
        return null;
    }

    return $fetchedTweets[0];
};

function displayTweet(array $entry): array
{
    $inReplyToStatusId = $entry['in_reply_to_status_id'];

    if ($inReplyToStatusId === '') {
        $replies = 'unknown';
    } else {
        if ($inReplyToStatusId) {
            global $findTweet;
            $tweet = $findTweet($inReplyToStatusId);
            if ($tweet) {
                $replies = displayTweet($tweet);
            } else {
                $replies = $inReplyToStatusId;
            }
        } else {
            $replies = null;
        }
    }
    
    return [
        'status_id' => $entry['status_id'],
        'replies' => $replies,
        'texte_brut' => $entry['texte_brut'],
        'texte_html' => $entry['texte_html'],
        'date_publication' => $entry['date_publication']
    ];
};

$tweets = array_map(
    'displayTweet',
    $fetcher->query($query, $queryParams)
);

http_response_code(200);
echo json_encode($tweets);
exit;
