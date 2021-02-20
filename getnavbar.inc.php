<?php
$default_page_title = "Pierre Miniggio";
$page_title = $default_page_title.' - ';

$hashtag_lien = "#";
$lienretourpublis = "index.php?onglet=actus#menu";

$avanttitre = "&nbsp;|&nbsp;&nbsp;";
$aprestitre = "&nbsp;&nbsp;|&nbsp;";
$titreactus = "Journal";
$titreactu = "<- Voir les autres publications";
$titrequisuisje = "Qui suis-je ? / Contact";
$titreapps = "Applications / Sites Internet";
$titrevideo = "Vidéos";
$titremusique = "Musiques";
$titrejeux = "Jeux";
$titrementions = "Mentions Légales";

if (isset($_GET['onglet'])) {
    if ($_GET['onglet'] == "actus") {
        $onglet = "actus";
        $titreonglet = $titreactus;
        $liencurrent = $hashtag_lien;
    }
    else if ($_GET['onglet'] == "actu") {
        include_once 'utils.php';
        $conn = Utils::connecter();
        $sql = 'SELECT * FROM actualites WHERE statut = 1 AND id_actu = '.$_GET['id'].' ORDER BY date_actu DESC;';
        $result = Utils::querySQL($sql, $conn);
        foreach ($result-> fetchAll() as $a) {
            $titretags = explode(']', $a['titre']);
            $titre = $titretags[(sizeof($titretags)-1)];
            $tags = ' |';
            $tailletags = sizeof($titretags);
            if ($tailletags > 1) {
                for ($i=0; $i<$tailletags-1; $i++) {
                    $tag = substr($titretags[$i],1);
                    $tags = $tags.' #'.$tag.'';
                }
            }
        }
        Utils::deconnecter($conn);
        if (!isset($titre)) {
            header('Location: index.php?onglet=actus');
        }
        $onglet = "actu";
        $titreonglet = $titre.$tags;
        $liencurrent = $lienretourpublis;
        $titreongletnavbar = $titreactu;

    }
    else if ($_GET['onglet'] == "quisuisje") {
        $onglet = "quisuisje";
        $titreonglet = $titrequisuisje;
        $liencurrent = $hashtag_lien;
    }
    else if ($_GET['onglet'] == "apps") {
        $onglet = "apps";
        $titreonglet = $titreapps;
        $liencurrent = $hashtag_lien;
    }
    else if ($_GET['onglet'] == "video") {
        $onglet = "video";
        $titreonglet = $titrevideo;
        $liencurrent = $hashtag_lien;
    }
    else if ($_GET['onglet'] == "musique") {
        $onglet = "musique";
        $titreonglet = $titremusique;
        $liencurrent = $hashtag_lien;
    }
    else if ($_GET['onglet'] == "jeux") {
        $onglet = "jeux";
        $titreonglet = $titrejeux;
        $liencurrent = $hashtag_lien;
    }
    else if ($_GET['onglet'] == "mentions") {
        $onglet = "mentions";
        $titreonglet = $titrementions;
        $liencurrent = $hashtag_lien;
    }
    else {
        header("Location : index.php");
    }

    if (! isset($titreongletnavbar)) {
        $titreongletnavbar = $titreonglet;
    }

    $page_title = $page_title.$titreonglet;
}
else {
    $onglet = "quisuisje";
    $titreonglet = $titrequisuisje;
    $liencurrent = $hashtag_lien;
    $page_title = $default_page_title;
    $titreongletnavbar = $titreonglet;
}

if (isset($_GET['errormsg'])) {
    $errormsg = $_GET['errormsg'];

    $onloadbody = ' onload="errorpopup()"';
    $popupscript1 = '<script>
    function errorpopup() {
        alert("';
    $popupscript2 = '")  ;
}
</script>';
    $formerror = "Formulaire de contact incorrectement rempli";
    if ($errormsg == "formerror") {
        $displaymessage = $formerror;
    }

    if ($errormsg == "formemailerror") {
        $displaymessage = $formerror." - Email incorrect";
    }

    if ($errormsg == "formmessageerror") {
        $displaymessage = $formerror." - Message vide";
    }

}

else {
    $popupscript1 = '';
    $displaymessage = '';
    $popupscript2 = '';
    $onloadbody = '';
}


if (isset($_GET['contact'])) {
    if ($_GET['contact'] == "active") {
        $contactactive = " active";
    }
    else {
        $contactactive = "";
    }
}
else {
        $contactactive = "";
}
