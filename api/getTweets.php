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

$query = $fetcher->createQuery(
    'social__publication'
)->select(
    'id_publication_source as status_id',
    'in_reply_to_status_id as in_reply_to_status_id',
    'texte_brut',
    'texte_html',
    'date_publication'
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

$tweets = array_map(
    fn (array $entry) => [
        'status_id' => $entry['status_id'],
        'in_reply_to_status_id' => $entry['in_reply_to_status_id'] === '' ? 'unknown' : (
            $entry['in_reply_to_status_id'] ?? null
        ),
        'texte_brut' => $entry['texte_brut'],
        'texte_html' => $entry['texte_html'],
        'date_publication' => $entry['date_publication']
    ],
    $fetcher->query($query, $queryParams)
);

http_response_code(200);
echo json_encode($tweets);
exit;
