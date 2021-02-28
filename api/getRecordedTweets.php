<?php

use App\ConfigProvider;
use App\Database\DatabaseFetcherFactory;
use App\Security\BearerTokenChecker;
use NeutronStars\Database\Query;
use PierreMiniggio\DatabaseConnection\DatabaseConnection;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

BearerTokenChecker::check();

$fetcher = (new DatabaseFetcherFactory())->make(DatabaseConnection::UTF8_MB4);

$limit = 30;
$offset = 0;

$config = ConfigProvider::get();

$tweets = $fetcher->query(
    $fetcher
        ->createQuery($config['db']['site-db'] . '.social__publication')
        ->select('id_post as id', 'texte_brut as content')
        ->orderBy('date_publication as published_at', Query::ORDER_BY_DESC)
        ->limit($limit, $offset)
);

http_response_code(200);
echo json_encode($tweets);
exit;
