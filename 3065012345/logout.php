<?php
session_start();
$_POST['psw'] = '';
$_SESSION['psw'] = '';
unset($_POST['psw']);
unset($_SESSION['psw']);
unset($psw);
session_destroy();
echo 'logout';
header('Location: index.php');

