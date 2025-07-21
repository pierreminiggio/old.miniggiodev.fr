<?php

$currentFolder = __DIR__ . DIRECTORY_SEPARATOR;
$cacheFolder = $currentFolder . 'cache' . DIRECTORY_SEPARATOR;

if (! file_exists($cacheFolder)) {
    mkdir($cacheFolder);
}

$config = require
    $currentFolder
    . '..'
    . DIRECTORY_SEPARATOR
    . 'config.php'
;
$settings = $config['twitter-api']['pierreminiggio'];

// Your credentials
$consumer_key = $settings['consumer_key'];
$consumer_secret = $settings['consumer_secret'];

$credentials = base64_encode(urlencode($consumer_key) . ':' . urlencode($consumer_secret));

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'https://api.twitter.com/oauth2/token',
    CURLOPT_HTTPHEADER => [
        'Authorization: Basic ' . $credentials,
        'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
    ],
    CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true
]);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
$bearer_token = $data['access_token'] ?? null;

if (!$bearer_token) {
    die('Error: No Bearer Token');
}

include_once $currentFolder . 'utils.php';

$conn = Utils::connecter();
$dbConfig = $config['db'];

$sql = "SELECT id_publication_source, date_publication FROM " . $dbConfig['site-db']  . ".social__publication ORDER BY id_post DESC LIMIT 1";
$result = Utils::querySQL($sql, $conn);
$counter = 0;

foreach ($result->fetchAll() as $entry) {
    $since_id = $entry['id_publication_source'];
    $afterDate = $entry['date_publication'];
    break;
}

if (empty($since_id) || empty($afterDate)) {
    echo 'Need sinceId and afterDate values to run the script';
    die;
}

$username = 'PierreMiniggio'; // Without @

function handleRateLimitMessage($lastSavedAt = null) {
    echo "\nℹ️ Too Many Requests. Please wait ~15 minutes.\n";
    if ($lastSavedAt) {
        $elapsed = time() - strtotime($lastSavedAt);
        $minutesAgo = floor($elapsed / 60);
        $secondsAgo = $elapsed % 60;
        echo "⏱️ Last token was saved $minutesAgo min $secondsAgo sec ago ($lastSavedAt).\n";
    }
}

// Get user ID
function getUserId($username, $bearer_token) {
    global $cacheFolder;
    $cachePath = $cacheFolder . 'user_cache.json';
    $cache = [];

    // Load existing cache if available
    if (file_exists($cachePath)) {
        $cacheContent = file_get_contents($cachePath);
        $cache = json_decode($cacheContent, true) ?? [];
    }

    // Return from cache if username is already stored
    if (isset($cache[$username])) {
        echo "✅ Loaded user ID for @$username from cache.\n";
        return $cache[$username];
    }

    // Fetch from Twitter API
    $url = "https://api.twitter.com/2/users/by/username/$username";
    $headers = ["Authorization: Bearer $bearer_token"];
    $ch = curl_init($url);
    curl_setopt_array($ch, [CURLOPT_HTTPHEADER => $headers, CURLOPT_RETURNTRANSFER => true]);
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response, true);

    if (! isset($data['data'])) {
        if (isset($data['status']) && $data['status'] === 429) {
            [, $lastSavedAt] = loadPaginationTokenAndTimestamp();
            handleRateLimitMessage($lastSavedAt);

            return null;
        }

        if (isset($data['title']) && $data['title'] === 'UsageCapExceeded') {
            echo "❌ Monthly usage cap exceeded. No more API calls allowed until quota resets.\n";
            
            return null;
        }

        echo "❌ Failed to fetch user ID for @$username. Response: " . json_encode($data) . "\n";
        return null;
    }

    $user_id = $data['data']['id'] ?? null;

    if ($user_id) {
        $cache[$username] = $user_id;
        file_put_contents($cachePath, json_encode($cache, JSON_PRETTY_PRINT));
        echo "📝 Cached user ID for @$username.\n";
    }

    return $user_id;
}

function loadPaginationTokenAndTimestamp(): array {
    global $cacheFolder;
    $cacheFile = $cacheFolder . 'pagination_token.json';
    $pagination_token = null;
    $lastSavedAt = null;

    if (file_exists($cacheFile)) {
        $cacheData = json_decode(file_get_contents($cacheFile), true);
        if (is_array($cacheData)) {
            $pagination_token = $cacheData['token'] ?? null;
            $lastSavedAt = $cacheData['saved_at'] ?? null;
        }
    }

    return [$pagination_token, $lastSavedAt];
}


function fetchTweetsWithCacheAndFilter($user_id, $bearer_token, $since_id, $afterDate) {
    global $cacheFolder;
    $paginationTokenCacheFile = $cacheFolder . 'pagination_token.json';

    [$pagination_token, $lastSavedAt] = loadPaginationTokenAndTimestamp();

    $max_pages = 8;
    $last_page_reached = false;
    $allTweets = [];

    for ($i = 0; $i < $max_pages; $i++) {
        $url = "https://api.twitter.com/2/users/$user_id/tweets?max_results=100&tweet.fields=created_at";
        if ($pagination_token) {
            $url .= "&pagination_token=$pagination_token";
        }

        $headers = ["Authorization: Bearer $bearer_token"];
        $ch = curl_init($url);
        curl_setopt_array($ch, [CURLOPT_HTTPHEADER => $headers, CURLOPT_RETURNTRANSFER => true]);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        if (!isset($data['meta'])) {
            if (isset($data['status']) && $data['status'] === 429) {
                handleRateLimitMessage($lastSavedAt);
                break;
            }

            if (isset($data['title']) && $data['title'] === 'UsageCapExceeded') {
                echo "❌ Monthly usage cap exceeded. No more API calls allowed until quota resets.\n";
                break;
            }

            // Handle expired or invalid pagination token
            if (
                isset($data['title'], $data['detail']) &&
                $data['title'] === 'Invalid Request' &&
                str_contains($data['detail'], 'pagination_token')
            ) {
                echo "⚠️ Invalid or expired pagination token. Clearing cache and stopping.\n";
                if (file_exists($paginationTokenCacheFile)) {
                    unlink($paginationTokenCacheFile);
                }
                break;
            }

            echo "❌ Unexpected API response. Stopping. Response : " . json_encode($data) . "\n";
            break;
        }

        if (isset($data['meta']['next_token'])) {
            file_put_contents($paginationTokenCacheFile, json_encode([
                'token' => $pagination_token,
                'saved_at' => date('Y-m-d H:i:s')
            ], JSON_PRETTY_PRINT));
            echo "➡️ Saved pagination token for next run: $pagination_token\n";
            echo "ℹ️ Not last page yet, caching token only.\n";
            
            if (!empty($data['data'])) {
                $oldestTweet = end($data['data']);
                echo "🕰️ Oldest tweet on this page:\n";
                echo "- [{$oldestTweet['id']}] {$oldestTweet['text']} ({$oldestTweet['created_at']})\n";
            }
        } else {
            // Last page reached
            // if (file_exists($paginationTokenCacheFile)) {
            //     unlink($paginationTokenCacheFile);
            // }
            echo "✅ Last page reached, cache cleared.\n";
            $last_page_reached = true;
        }

        // If this is the last page, collect its tweets
        if ($last_page_reached && isset($data['data'])) {
            $allTweets = array_merge($allTweets, $data['data']);
        }
    }

    if ($last_page_reached) {
        // Reverse to show oldest → newest
        $allTweets = array_reverse($allTweets);

        // Apply filters
        $filtered = [];
        $after_timestamp = strtotime($afterDate);
        foreach ($allTweets as $tweet) {
            $created_at = strtotime($tweet['created_at']);
            if (bccomp($tweet['id'], $since_id) === 1 && $created_at > $after_timestamp) {
                $filtered[] = $tweet;
            }
        }
        return $filtered;
    }

    return [];
}


$user_id = getUserId($username, $bearer_token);
if (!$user_id) {
    die("❌ Failed to retrieve user ID for @$username\n");
}

$tweets = fetchTweetsWithCacheAndFilter($user_id, $bearer_token, $since_id, $afterDate);

if (count($tweets) > 0) {
    echo "✅ Displaying " . count($tweets) . " new tweets AFTER id $since_id and date $afterDate:\n\n";
    foreach ($tweets as $tweet) {
        echo "- [{$tweet['id']}] {$tweet['text']} ({$tweet['created_at']})\n";
    }
} else {
    echo "ℹ️ No tweets to display this run (waiting for pagination to catch up).\n";
}
