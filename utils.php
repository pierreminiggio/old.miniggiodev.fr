<?php
class Utils
{

    static function connecter()
    {
        $config = require
            __DIR__
            . DIRECTORY_SEPARATOR
            . 'config.php'
        ;
        $dbConfig = $config['db'];

        $conn = null;
        try {
            $conn = new PDO(
                'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['site-db'] . ';charset=utf8',
                $dbConfig['username'],
                $dbConfig['password']
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo 'Echec de connexion:'.$e->getMessage();
        }
        return $conn;
    }

    static function deconnecter($conn)
    {
        $conn = null;
    }

    static function querySQL($sql, $conn)
    {
        try {
            $result = $conn->query($sql);
            return $result;
        } catch (PDOException $ex) {
            header('Location: index.php');
            //echo "Erreur SQL";
        }

    }

    static function execSQL($sql, $conn)
    {
        try {
            $conn->exec($sql);
        } catch (PDOException $ex) {
            header('Location: index.php');
            //echo "Erreur SQL";
        }

    }
}
