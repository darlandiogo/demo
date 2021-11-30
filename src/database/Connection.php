<?php

namespace App\Demo\Database;

class Connection 
{
    protected static $conn = null;

    public static function createConection( $host, $database, $user, $senha ) {
        try {
            if(is_null(self::$conn)) {
                self::$conn = new \PDO('mysql:host='.$host.';dbname='.$database,$user,$senha);
                self::$conn->exec("set names utf8");
            }
            return self::$conn;
        } catch(\Exception $e) {
            throw new \PDOException(' Error ao estabelecer a conexão: ' . $e->getMessage());
        }
    }

    public static function getConnection() {
        return self::$conn;
    }
}