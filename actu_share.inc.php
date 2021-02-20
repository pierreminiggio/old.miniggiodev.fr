<?php

echo '<ul class="res-share">';

$lien_share_fb = (
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://'
) . $_SERVER['HTTP_HOST'] . '/index.php?onglet=actu&id=' . $a['id_actu'] . '#publi';

echo '<li>';

include 'fb-share/bouton.inc.php';

echo $button_share_fb;

echo '</li>';

echo '<li class="twitter-ape">';

include 'tw-share/bouton.inc.php';

echo $button_share_tw;

echo '</li>';

echo '</ul>';

