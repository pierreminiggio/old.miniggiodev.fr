<?php
    if (isset($_GET['app'])) {
        $app = $_GET['app'];

        if ($app == "applipref" ) {
            $appname = "L'application des fournitures de la préfecture d'Avignon";
        }
        else if ($app == "sitenatureanimaleservice" ) {
            $appname = "Le site Nature-Animale-Service";
        }

        else if ($app == "nuitinfo2017" ) {
            $appname = "Le calendrier de l'avent inspiré de l'univers Ubisoft";
        }

        else if ($app == "blogrtai" ) {
            $appname = "Le blog de la formation RTAI";
        }
        else {
            header('Location: index.php?onglet=apps#menu');
        }
    }
    else {
            header('Location: index.php?onglet=apps#menu');
        }
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php include './head.inc.php'; ?>
        <meta charset="UTF-8">
        <title>Pierre Miniggio</title>
        <style>
            h2 {
                margin: 0;
                padding-top: 50px;
                margin-bottom: 50px;
            }
            p {
                text-align: justify;
            }
            .paddingation {
                padding-left: 5px;
                padding-right: 5px;
            }
            @media screen and (min-width: 800px) {
                .paddingation {
                    padding-left: 10%;
                    padding-right: 10%;
                }
            }
        </style>
    </head>
    <body>
        <nav>

    <div class="nav-wrapper orange darken-2" id="menu">
        <ul id="nav-mobile" class="orange darken-2">
            <li><a class="grey-text text-lighten-3" href="index.php?onglet=apps#<?=$app?>"><- Retour<span class="hide-on-small-only"> aux applications</span></a></li>
        </ul>
        <ul id="nav-mobile" class="orange darken-2 right">
            <li><a class="grey-text text-lighten-3" href="index.php">Page d'accueil</a></li>
        </ul>
    </div>
</nav>
        <div class="content paddingation">
            <h2><?= $appname ?></h2>
            <?php include './'.$app.'.inc.php'; ?>
        </div>


        <?php include './footer.inc.php'; ?>
    </body>
</html>
