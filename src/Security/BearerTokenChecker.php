<?php

namespace App\Security;

use App\ConfigProvider;

class BearerTokenChecker
{

    public static function check(): void
    {
        $config = ConfigProvider::get();
        $validToken = $config['apiToken'];
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;

        if (! $authHeader || $authHeader !== 'Bearer ' . $validToken) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }
    }
}
