<!DOCTYPE html>
<?php include './getnavbar.inc.php';
$photo = "images/photo-pierre-miniggio.png";
?>

<html>
    <head>
        <?php include './head.inc.php'; ?>
        <meta charset="UTF-8">
        <meta property="og:image" content="https://miniggiodev.fr/images/logo.png">
        <meta property="og:site_name" content="Pierre Miniggio">
        <meta property="og:description" content="Développeur Web, Video Maker, Musicien!">
        <title><?=$page_title?></title>
    </head>
    <body<?=$onloadbody?>>
    <a
        href="https://miniggiodev.fr"
        target="_blank"
        style="
            color: #FFF;
            background-color: #F44336;
            position: fixed;
            width: 100%;
            text-align: center;
            z-index: 1;
        "
    >Ce site n'est plus mis à jour depuis 2018, un nouveau site sera disponible (un jour peut être) en cliquant ici</a>
        <div class="fond-onglet fond-<?=$onglet?>">
        <div id="mobile-pres" class="hide-on-large-only">
            <h1>Pierre Miniggio</h1>
            <h2>- Développeur Web - Video maker - Musicien -</h2>
            <h3></h3>
        </div>
            <div class="parallax-container hide-on-med-and-down" id="parallax">
                <div class="parallax">
                    <h1>Pierre Miniggio</h1>
                    <h2>- Développeur Web - Video maker - Musicien -</h2>
                    <h3></h3>
                    <img src="images/parallax/1.png" height="1280" width="1280">
                </div>
            </div>
            <div class="content">
                <?php include './navbar.inc.php'; ?>
                <?php include './'.$onglet.'.inc.php'; ?>
            </div>

        </div>
        <?php include './footer.inc.php'; ?>
        <script>
            // Bonjour
            console.log('Bonjour chère personne qui aime regarder la console :P');
        </script>
    </body>
</html>
