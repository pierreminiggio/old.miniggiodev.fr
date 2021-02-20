<?php

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    switch($msg) {
        case 'merci':
            $message = 'Mail envoyé avec succès!';
            break;
        case 'erreur':
            $message = 'Erreur : Mail non-envoyé';
            break;
        default :
            $message = 'Erreur : Paramètre URL incorrect. Essaie pas d\'me tromper! :3';
            break;
    }
}
else {
    header('Location: merci.php?msg=erreur');
}
?>

<html>
    <head>
        <?php include './head.inc.php'; ?>
        <meta charset="UTF-8">
        <title>Merci pour le message!</title>
    </head>
    <body>
        <div class="mailbox center-align">
            <h2><?php echo $message; ?></h2>
            <img src="images/nyanmail.gif" class="responsive-img">
            <br><a href="index.php?onglet=quisuisje#contact" class="white-text text-lighten-4 waves-effect waves-light btn orange darken-4 fleche">Retour</a>
        </div>
    </body>
</html>
