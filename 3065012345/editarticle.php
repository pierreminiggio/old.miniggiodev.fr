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

// On récupère les données du formulaire
$titre = $_POST['titre'];
$contenu = $_POST['contenu'];
$date_actu = $_POST['date_actu'];
$statut = $_POST['statut'];



if (isset($_POST['creer'])) {
    // On insert
    include_once '../utils.php';
    $conn = Utils::connecter();
    $sql = 'INSERT INTO actualites (titre, contenu, date_actu, statut) VALUES ("'.$titre.'", "'.$contenu.'", "'.$date_actu.'", '.$statut.')';
    echo $sql;
    Utils::execSQL($sql, $conn);
}
else {
    // On modifie
    $id_actu = $_POST['id_actu'];
    
    include_once '../utils.php';
    $conn = Utils::connecter();
    $sql = 'UPDATE actualites SET titre = "'.$titre.'", contenu = "'.$contenu.'", date_actu = "'.$date_actu.'", statut = '.$statut.' WHERE id_actu = '.$id_actu.';';
    Utils::execSQL($sql, $conn);
}

// On a finit on rentre à la maison
header('Location : index.php?onglet=articles');