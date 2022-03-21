<?php

namespace App\Demo\Database;

use App\Demo\Util\Env;
use App\Demo\Database\Connection;
use App\Demo\Database\QueryBuilder;
use App\Demo\Exception\NotFoundException;

class ConnectionFactory {

    public static function create()
    {
        $env  = Env::load();
        if(empty($env)) {
            throw new NotFoundException('File .env is empty');
        }

        return Connection::createConection($env["DB_HOST"], $env["DB_DATABASE"], $env["DB_USERNAME"], $env["DB_PASSWORD"]);
        
    }

    public static function getConnection()
    {
        $conn = Connection::getConnection();
        if($conn) {
            return new QueryBuilder ($conn);
        }

        return new QueryBuilder(self::create());
    }
}