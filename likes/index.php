<?php

use App\Database\DatabaseFetcherFactory;
use PierreMiniggio\DatabaseConnection\DatabaseConnection;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$fetcher = (new DatabaseFetcherFactory())->make(DatabaseConnection::UTF8_MB4);

$displayDates = function (): void
{
    echo 'Choisissez une date';
    exit;
};

$dateParam = $_GET['date'] ?? null;

if ($dateParam === null) {
    $displayDates();
}

try {
    $date = new DateTimeImmutable((new DateTimeImmuTable($dateParam))->format('Y-m-d'));
} catch (Exception) {
    $displayDates();
}

$videoedDay = $date->add(new DateInterval('P1D'));

$fetchedLikes = $fetcher->query(
    $fetcher
        ->createQuery('social__youtube')
        ->select( 'youtubeid', 'title', 'channel_id', 'created_at as liked_at')
        ->where('videoed_at >= :start_of_the_day AND videoed_at <= :end_of_the_day')
        ->orderBy('created_at')
    ,
    ['start_of_the_day' => $videoedDay->format('Y-m-d H:i:s'), 'end_of_the_day' => $videoedDay->format('Y-m-d') . ' 23:59:59']
);

//var_dump($fetchedLikes);

$title = 'Ce que j\'ai regardé le ' . $date->('d/m/Y');

echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

    <h1 style="text-align: center;">$title</h1>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
HTML;
