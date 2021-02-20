<?php

header('Access-Control-Allow-Origin: *');
 
include '../utils.php';

function updateMemo($newContent)
{
    $conn = Utils::connecter();
    $sql = 'INSERT INTO utils__memo (content, created_at) VALUES (\'' . addslashes($newContent) . '\', NOW());';
    Utils::execSQL($sql, $conn);
    Utils::deconnecter($conn);
}

isset($_POST['memo']) && updateMemo(urldecode($_POST['memo']));
