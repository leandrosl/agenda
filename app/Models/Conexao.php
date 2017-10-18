<?php

namespace Agenda\Models;

use PDO;

class Conexao
{
    private static $pdo;
    
    public static function getConexao()
    {
        $dbHost = DB_HOST;
        $dbPort = DB_PORT;
        $dbName = DB_NAME;
        $dbUsername = DB_USERNAME;
        $dbPassword = DB_PASSWORD;

        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO("mysql:host={$dbHost}:{$dbPort};dbname={$dbName};charset=utf8", 
                    $dbUsername, $dbPassword);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$pdo;
    }
}