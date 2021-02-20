<?php
    $name = $_GET['n'] ?? 'Dupont';
    $message = 'Joyeux anniversaire ' . $name . ' !';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C'est un grand jour pour toi <?php echo $name; ?></title>
</head>
<body>
    <h1 style="text-align: center;"><?php echo $message; ?></h1>
</body>
</html>
