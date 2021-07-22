<?php

namespace App\Query;

use Exception;

class ChannelInfosQuery
{

    /**
     * @throws Exception
     */
    public function execute(string $channelId): array
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://youtube-channel-infos-api.miniggiodev.fr/' . $channelId
        ]);

        $result = curl_exec($curl);
        curl_close($curl);

        if (! empty($result)) {
            $jsonResult = json_decode($result, true);
            if (! empty($jsonResult)) {
                return $jsonResult;
            }
        }

        throw new Exception('Unexpected Error');
    }
}