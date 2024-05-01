<?php

error_reporting(E_ALL);

ini_set('display_errors', 1);

echo 'Recuperation des tweets en cours...<br>';

require_once 'data.php';

$twitterApiVersion = '2';

d_get_posts($twitterApiVersion);

echo 'Tweets récupérés!';

exit();

