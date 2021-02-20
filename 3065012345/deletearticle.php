<?php
session_start();
if(isset($_POST['psw']) || isset($_SESSION['psw'])) {
    $psw = '';
    if(isset($_SESSION['psw'])) {
        $psw = $_SESSION['psw'];
    }
    else {
        $psw = $_POST['psw'];
    }
    include_once '../utils.php';

    $conn = Utils::connecter();

    $sql = 'SELECT psw FROM dashboard';
    $result = Utils::querySQL($sql, $conn);

    foreach ($result-> fetchAll() as $a) {
        if ($a['psw'] == $psw.'connaitlemdp') {
            $login = true;
            $_SESSION['psw'] = $psw;
            unset($_POST['psw']);
        }
    }
    Utils::deconnecter($conn);
}

if ($login == false) {
    header('Location : form.php');
}

// On récupère l'id de l'article
$id_actu = $_POST['id_actu'];
include_once '../utils.php';
$conn = Utils::connecter();
$sql = 'DELETE FROM actualites WHERE id_actu = '.$id_actu.';';
Utils::execSQL($sql, $conn);

// On a finit on rentre à la maison
header('Location : index.php?onglet=articles');