<?php

namespace Core;

use PDO;
use App\Config;

class Model
{
    /**
     * Retorna a conexão com o banco de dados
     * 
     * @return mixed
     */
    protected static function getDb()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=' .Config::DB_HOST. ':' .Config::DB_PORT. ';dbname=' .Config::DB_NAME. ';charset=utf8';
            $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

            // Levanta uma excessão em caso de erro
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }
}