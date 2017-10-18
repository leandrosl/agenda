<?php

namespace Agenda\Models;

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
                $pdo = new PDO("mysql:host={$dbHost}:{$dbPort},dbname={$dbName}", 
                    $dbUsername, $dbPassword);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$pdo;
    }
}