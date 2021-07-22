<?php

use App\Database\DatabaseFetcherFactory;
use App\Query\ChannelInfosQuery;
use App\Query\ChannelTwitterQuery;
use PierreMiniggio\DatabaseConnection\DatabaseConnection;

$protocol = isset($_SERVER['HTTPS']) ? 'https' : 'http';
$host = $protocol . '://' . $_SERVER['HTTP_HOST'];
if (str_ends_with($host, '/')) {
    $host = substr($host, 0, -1);
}

$likePath = explode('?', $_SERVER['REQUEST_URI'])[0];
$likeUrl = $host . $likePath . '?date=';

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$fetcher = (new DatabaseFetcherFactory())->make(DatabaseConnection::UTF8_MB4);

$displayDates = function() use ($likeUrl): void
{
    $title = 'Le choix dans la date';
    $exampleDateUrl = $likeUrl . (new DateTimeImmutable())->modify('-2 days')->format('Y-m-d');

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
        <nav style="width: 100%;" class="orange darken-2 grey-text text-lighten-3">
            <p style="text-align: center;">$title</p>
        </nav>
        <h1 style="text-align: center;">$title</h1>
        <p style="text-align: center;">Pour visualiser les likes, choisissez une date, exemple : <a href="$exampleDateUrl">$exampleDateUrl</a></p>
    </body>
    </html>
    HTML;
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

$htmlLikes = '';
if (! count($fetchedLikes)) {
    $htmlLikes = <<<HTML
        <h2 style="text-align: center;">Rien du tout mdr</h2>
        <p style="text-align: center;">(D'après mon bot, autant il a juste pas tourné ce jour-là...)</p>
    HTML;
    goto render;
}

$htmlLikes .= <<<HTML
    <ul class="collection">
HTML;

$topToolTip = <<<HTML
    data-position="top"
HTML;

$watchVideoToolTip = <<<HTML
    $topToolTip
    data-tooltip="Regarder la vidéo"
HTML;

$checkChannelToolTip = <<<HTML
    $topToolTip
    data-tooltip="Visiter la chaîne"
HTML;

$checkTwitterToolTip = <<<HTML
    $topToolTip
    data-tooltip="Visiter le twitter"
HTML;

$channelsInfos = [];
$channelInfosQuery = new ChannelInfosQuery();

$channelsTwitter = [];
$channelTwitterQuery = new ChannelTwitterQuery();

$isAnyVideoLikedAnotherDay = false;

foreach ($fetchedLikes as $fetchedLike) {
    $likedAt = new DateTimeImmutable($fetchedLike['liked_at']);
    $videoLink = 'https://youtu.be/' . $fetchedLike['youtubeid'];
    $channelId = $fetchedLike['channel_id'];
    $channelLink = 'https://youtube.com/channel/' . $channelId;

    $isLikedSameDay = $likedAt->format('Y-m-d') === $date->format('Y-m-d');
    if (! $isAnyVideoLikedAnotherDay && ! $isLikedSameDay) {
        $isAnyVideoLikedAnotherDay = true;
    }

    $likeHintHtml = ! $isLikedSameDay ? <<<HTML
         (Liké le {$likedAt->format('d/m/Y')})
    HTML : '';

    if ($channelId && ! isset($channelsInfos[$channelId])) {
        try {
            $channelsInfos[$channelId] = $channelInfosQuery->execute($channelId);
        } catch (Exception) {
            $channelsInfos[$channelId] = null;
        }
    }

    $channelInfos = $channelsInfos[$channelId];
    $channelName = ! empty($channelInfos) && ! empty($channelInfos['title']) ? $channelInfos['title'] : null;
    $channelPhoto = ! empty($channelInfos) && ! empty($channelInfos['photo']) ? $channelInfos['photo'] : null;

    $channelHtml = $channelId ? <<<HTML
        <a
            href="$channelLink"
            target="_blank"
            class="tooltipped"
            $checkChannelToolTip
        >▶️ $channelName</a>
    HTML : '';

    if ($channelId && ! isset($channelsTwitter[$channelId])) {
        try {
            $channelsTwitter[$channelId] = $channelTwitterQuery->execute($channelId);
        } catch (Exception) {
            $channelsTwitter[$channelId] = null;
        }
    }

    $channelTwitter = $channelsTwitter[$channelId];

    $twitterHtml = $channelTwitter ? <<<HTML
        <a
            href="https://twitter.com/$channelTwitter"
            target="_blank"
            class="tooltipped"
            $checkTwitterToolTip
        >🐦 $channelTwitter</a>
    HTML : '';

    $brIfNeeded = $channelHtml && $twitterHtml ? <<<HTML
        <br>
    HTML : '';

    $htmlLikes .= <<<HTML
        <li class="collection-item avatar">
            <a
                href="$channelLink"
                target="_blank"
                class="tooltipped"
                $checkChannelToolTip
            ><img
                src="$channelPhoto"
                alt="Photo de la chaîne de $channelName"
                class="circle"
            ></a>
            <span class="title"><a
                href="$videoLink"
                target="_blank"
                class="tooltipped"
                $watchVideoToolTip
            >{$fetchedLike['title']}$likeHintHtml</a></span>
            <p>{$channelHtml}{$brIfNeeded}{$twitterHtml}</p>
            <a
                href="$videoLink"
                target="_blank"
                class="secondary-content tooltipped"
                $watchVideoToolTip
            ><i
                class="material-icons red"
                style="border-radius: 50%; color: #FFF;"
            >play_arrow</i></a>
        </li>
    HTML;
}

$htmlLikes .= <<<HTML
    </ul>
HTML;

render:
$title = 'Ce que j\'ai regardé le ' . $date->format('d/m/Y');
$likeDateWarningHtml = ! empty($isAnyVideoLikedAnotherDay) ? <<<HTML
    <p style="text-align: center;">S'il y a une date de like d'indiquée, c'est que mon bot a du retard sur la réalité, sûrement car il n'a pas tourné quelques jours :P</p>
HTML : '';

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
    <nav style="display: flex; justify-content: space-between;" class="orange darken-2 grey-text text-lighten-3">
        <a
            href="$likeUrl{$date->modify('-1 day')->format('Y-m-d')}"
            style="flex: auto 0;"
        ><- Avant</a>
        <a
            href="$likeUrl{$date->modify('+1 day')->format('Y-m-d')}"
            style="flex: auto 0;"
        >Après -></a>
    </nav>
    <h1 style="text-align: center;">$title</h1>
    $likeDateWarningHtml
    $htmlLikes
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const elems = document.querySelectorAll('.tooltipped');
        M.Tooltip.init(elems, {});
    });
    </script>
</body>
</html>
HTML;
