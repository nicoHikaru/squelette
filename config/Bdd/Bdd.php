<?php

namespace Config\Bdd;

use PDO;

class Bdd {
    

    private static ?PDO $pdo = null;

    public static function bdd():void
    {
        
                
        $pdo = new PDO("mysql:host=db;dbname=scriptPhp", "root", "teste");
        $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
        self::$pdo = $pdo;
    }

    public static function pdo()
    {
        return self::$pdo;
    }
}