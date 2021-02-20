<?php
$avanttitre = "&nbsp;|&nbsp;&nbsp;";
$aprestitre = "&nbsp;&nbsp;|&nbsp;";
$titrebienvenue = "Bienvenue sur le dashboard!";
$titrearticles = "Articles";

if (isset($_GET['onglet'])) {
    if ($_GET['onglet'] == "bienvenue") {
        $onglet = "bienvenue";
        $titreonglet = $titrebienvenue;
    }
    else if ($_GET['onglet'] == "articles") {
        $onglet = "articles";
        $titreonglet = $titrearticles;
    }
    else {
        header("Location : index.php");
    }
}
else {
    $onglet = "bienvenue";
    $titreonglet = $titrebienvenue;
}
