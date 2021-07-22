<?php

use App\Database\DatabaseFetcherFactory;
use App\Query\ChannelInfosQuery;
use App\Query\ChannelTwitterQuery;
use NeutronStars\Database\Query;
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

$oneDayInterval = new DateInterval('P1D');

$getOldestLikeDay = function () use ($fetcher): DateTimeInterface {
    return new DateTimeImmutable((new DateTimeImmutable($fetcher->query(
        $fetcher->createQuery(
            'social__youtube'
        )->select(
            'created_at'
        )->orderBy(
            'created_at'
        )->limit(
            1
        )
    )[0]['created_at']))->format('Y-m-d'));
};
$getMostRecentVideoDay = function () use ($fetcher, $oneDayInterval): DateTimeInterface {
    return new DateTimeImmutable((new DateTimeImmutable($fetcher->query(
        $fetcher->createQuery(
            'social__youtube'
        )->select(
            'videoed_at'
        )->orderBy(
            'videoed_at',
            Query::ORDER_BY_DESC
        )->limit(
            1
        )
    )[0]['videoed_at']))->sub($oneDayInterval)->format('Y-m-d'));
};

$oldestLikeDay = $getOldestLikeDay();
$mostRecentVideoDay = $getMostRecentVideoDay();
$displayDates = function(?string $error = null) use ($likeUrl, $oldestLikeDay, $mostRecentVideoDay): void
{
    $title = 'Le choix dans la date';
    $displayDate = function (DateTimeInterface $date) use ($likeUrl): string {
        $dateUrl = $likeUrl . $date->format('Y-m-d');
        return <<<HTML
            <a href="$dateUrl">{$date->format('d/m/Y')}</a>
        HTML;
    };

    if ($error) {
        $error = str_replace('\'', '\\\'', $error);
    }

    $errorScript = $error ? <<<HTML
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script>
            M.toast({
                html: '$error',
                classes: 'red'
            })
        </script>
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
        <nav style="width: 100%;" class="orange darken-2 grey-text text-lighten-3">
            <p style="text-align: center; margin: 0;">$title</p>
        </nav>
        <h1 style="text-align: center;">$title</h1>
        <p style="text-align: center;">Pour visualiser les likes, choisissez une date entre {$displayDate($oldestLikeDay)} et {$displayDate($mostRecentVideoDay)}</p>
        $errorScript
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
    $displayDates('La date entrée est incorrecte');
}

$videoedDay = $date->add($oneDayInterval);

$areLikesAlreadyThereForThisDate = function (DateTimeInterface $dateToCheck) use ($mostRecentVideoDay): bool {
    return $dateToCheck <= $mostRecentVideoDay;
};

if (! $areLikesAlreadyThereForThisDate($date)) {
    $displayDates('Les likes ne sont pas encore traités pour cette date');
}

$wereLikesAlreadyRecorded = function (DateTimeInterface $date) use ($oldestLikeDay): bool {
    return $date >= $oldestLikeDay;
};

if (! $wereLikesAlreadyRecorded($date)) {
    $displayDates('Les likes n\'étaient pas encore enregistrés à cette époque');
}

$fetchLikesBetweenDates = function (string $start, string $end, string $dateField) use ($fetcher): array {
    return $fetcher->query(
        $fetcher
            ->createQuery('social__youtube')
            ->select( 'youtubeid', 'title', 'channel_id', 'created_at as liked_at')
            ->where($dateField . ' >= :start AND ' . $dateField . ' <= :end')
            ->orderBy('created_at')
        ,
        ['start' => $start, 'end' => $end]
    );
};

$firstVideoDate = new DateTimeImmutable('2021-04-23');
$isVideoBotActive = $firstVideoDate < $videoedDay;
$fetchedLikes = $isVideoBotActive ? $fetchLikesBetweenDates(
    $videoedDay->format('Y-m-d H:i:s'),
    $videoedDay->format('Y-m-d') . ' 23:59:59',
    'videoed_at'
) : $fetchLikesBetweenDates(
    $date->format('Y-m-d H:i:s'),
    $date->format('Y-m-d') . ' 23:59:59',
    'created_at'
);

$htmlLikes = '';
if (! count($fetchedLikes)) {
    $emptyReason = $isVideoBotActive ? <<<HTML
        (D'après mon bot, autant il a juste pas tourné ce jour-là, ou bien j'avais dépassé le quota de l'API Youtube et pas encore réactivé...)
    HTML :<<<HTML
        (Ou bien j'avais probablement dépassé le quota de l'API Youtube et pas encore réactivé...)
    HTML;
    $htmlLikes = <<<HTML
        <h2 style="text-align: center;">Rien du tout mdr</h2>
        <p style="text-align: center;">$emptyReason</p>
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

    $channelInfos = $channelsInfos[$channelId] ?? null;
    $channelName = ! empty($channelInfos) && ! empty($channelInfos['title']) ? $channelInfos['title'] : null;
    $channelPhoto = ! empty($channelInfos) && ! empty($channelInfos['photo'])
        ? $channelInfos['photo']
        : 'https://youtube-channel-infos-api.miniggiodev.fr/placeholder.png'
    ;

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

    $channelTwitter = $channelsTwitter[$channelId] ?? null;

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

    $htmlChannelPhoto = <<<HTML
        <img
            src="$channelPhoto"
            alt="Photo de la chaîne de $channelName"
            class="circle"
        >
    HTML;

    $htmlChannelPhotoWithMaybeLink = $channelId ? <<<HTML
        <a
            href="$channelLink"
            target="_blank"
            class="tooltipped"
            $checkChannelToolTip
        >$htmlChannelPhoto</a>
    HTML : $htmlChannelPhoto;

    $htmlLikes .= <<<HTML
        <li class="collection-item avatar">
            $htmlChannelPhotoWithMaybeLink
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

$isVideoBotActiveHtml = ! $isVideoBotActive ? <<<HTML
    <p style="text-align: center;">Le bot qui tweet tout seul chaque jour n'était pas encore actif à ce moment là. Ça tweetait individuellement chaque vidéo dans l'heure :P</p>
HTML : '';

$previousDate = $date->sub($oneDayInterval);
$isPreviousDateDisplayed = $wereLikesAlreadyRecorded($previousDate);
$previousDateHtml = $isPreviousDateDisplayed ? <<<HTML
    <a
        href="$likeUrl{$previousDate->format('Y-m-d')}"
        style="flex: auto 0; padding: 0 20px;"
    ><- Avant</a>
HTML : '';

$nextDate = $date->add($oneDayInterval);
$nextDateHtml = $areLikesAlreadyThereForThisDate($nextDate) ? <<<HTML
    <a
        href="$likeUrl{$nextDate->format('Y-m-d')}"
        style="flex: auto 0; padding: 0 20px;"
    >Après -></a>
HTML : '';

$navJustifyContentStrategy = $isPreviousDateDisplayed ? 'space-between' : 'flex-end';

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
    <nav style="display: flex; justify-content: $navJustifyContentStrategy;" class="orange darken-2 grey-text text-lighten-3">
        $previousDateHtml
        $nextDateHtml
    </nav>
    <h1 style="text-align: center;">$title</h1>
    $likeDateWarningHtml$isVideoBotActiveHtml
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
