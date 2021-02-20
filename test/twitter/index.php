<?php
ini_set('display_errors', 1);
if( PHP_VERSION_ID < 50600 ){
    ini_set('mbstring.internal_encoding', 'UTF-8');
}else{
    ini_set('default_charset', 'UTF-8');
}
?>
<head>
    <meta charset="UTF-8">
    <title>Test api</title>
    <style>
        .media img {
            width: 300px;
            display: block;
        }

        .hashtag {
            color: orange;
        }

        .url {
            color: green;
        }

        .mention {
            color: red;
        }
    </style>
</head>

<body>
<h1>Test API Twitter</h1>
<?php
require_once('fonctions.php');
getProfile();
getTweets();
?>
<br><br><br>debug :<br>
</body>
<?php


// debug
debug();
