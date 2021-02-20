<?php

error_reporting(E_ALL);

ini_set('display_errors', 1);

echo 'Recuperation des tweets en cours...<br>';

require_once 'data.php';

d_get_posts();

echo 'Tweets récupérés!';

exit();

