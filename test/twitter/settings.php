<?php

// Set access tokens here - see: https://dev.twitter.com/apps/

$config = require
    __DIR__
    . DIRECTORY_SEPARATOR
    . '..'
    . DIRECTORY_SEPARATOR
    . '..'
    . DIRECTORY_SEPARATOR
    . 'config.php'
;
$twitterConfig = $config['twitter-api']['pierreminiggio'];

// SAME AS twitter/data.php
$settings = $twitterConfig;
