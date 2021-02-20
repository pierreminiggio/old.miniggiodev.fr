<?php
session_start();
$login = false;
if(isset($_POST['psw']) || isset($_SESSION['psw'])) {
    $psw = '';
    if(isset($_SESSION['psw'])) {
        $psw = $_SESSION['psw'];
    }
    else {
        $psw = $_POST['psw'];
    }
    include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'utils.php';

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
?>

<?php include __DIR__ . DIRECTORY_SEPARATOR . 'getnavbar.inc.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'head.inc.php'; ?>
        <meta charset="UTF-8">
        <title>Dashboard Admin</title>
        <link rel="icon" type="image/png" href = "logo.png">
        <link rel="stylesheet" type="text/css" href="../style.css">
        <style>
            h2 {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <?php include '../navbar.inc.php'; ?>
            <?php include './'.$onglet.'.inc.php'; ?>
        </div>
    </body>
</html>
