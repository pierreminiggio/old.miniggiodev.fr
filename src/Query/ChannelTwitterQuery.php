<?php

namespace App\Query;

use Exception;

class ChannelTwitterQuery
{

    /**
     * @throws Exception
     */
    public function execute(string $channelId): ?string
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://twitter-handle-finder-api.miniggiodev.fr/' . $channelId
        ]);

        $result = curl_exec($curl);
        curl_close($curl);

        if (! empty($result)) {
            $jsonResult = json_decode($result, true);
            if (! empty($jsonResult) && isset($jsonResult['twitter_handle'])) {
                return $jsonResult['twitter_handle'];
            }
        }

        throw new Exception('Unexpected Error');
    }
}