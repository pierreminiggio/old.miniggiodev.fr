<?php
if (isset($_POST['nom']) || isset($_POST['email']) || isset($_POST['objet']) || isset($_POST['message'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL) || $email='') {

    } else {
        header('Location: index.php?onglet=quisuisje&errormsg=formemailerror#contact');
        die();
    }

    $objet = trim($_POST['objet']);
    $message = trim($_POST['message']);

    if ($message == '') {
        header('Location: index.php?onglet=quisuisje&errormsg=formmessageerror#contact');
        die();
    }
}

else {
    header('Location: index.php?onglet=quisuisje&errormsg=formerror#contact');
    die();
}

$mail_pierre = "pierre.miniggio@gmail.com";
$headers = "Content-type: text/html; charset= utf8\n";

$headers1 = "From: ".$email."\n".$headers;
$to = $mail_pierre;
$objetmail = "Contact Web : ".$objet;
$bodymail = "Mail envoyé par ".$nom." (".$email." - ".$_SERVER['REMOTE_ADDR'].")<br><br>".$message;

$headers2 = "From: ".$mail_pierre."\n".$headers;
$to2 = $email;
$objetmail2 = "Contact Web : ".$objet;
$bodymail2 = "<div style=\"color: #fff; background-color: #0e4572;\">Merci, ".$nom." de m'avoir contacté grâce au formulaire de mon site.<br><br>Voici une copie du message que vous m'avez envoyé :<br><br>".$message."<br><br>Cordialement,<br>Le mail automatique obéissant sous les ordres de Pierre Miniggio<br><img src=\"https://miniggiodev.fr/images/nyanmail.png\"></div>";
if (mail($to , $objetmail , $bodymail, $headers1) && mail($to2 , $objetmail2 , $bodymail2, $headers2)) {
    header('Location: merci.php?msg=merci');
    die();
}
else {
    header('Location: merci.php?msg=erreur');
    die();
}
?>
