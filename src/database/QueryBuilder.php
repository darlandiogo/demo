<?php

namespace App\Demo\Database;

class QueryBuilder {

    private static $conn = null; 

    public function __construct(\PDO $conn) {
        self::$conn = $conn;
    }

    public function select(string $query)
    {
        $stm = self::$conn->query($query);
        while ($result = $stm->fetch()) {
            yield $result;
        }
    }

    public function count(string $query, string $count )
    {
        $stm     = self::$conn->query($query);
        $results = $stm->fetchAll();
        return $results[0][$count];   
    }
    
    public function lastInsertId () : int {
        return self::$conn->lastInsertId();
    }

    public function delete(string $query)
    {
        $stm = self::$conn->prepare($query);
        $stm->execute();
        return $stm->rowCount();
    }

    public function query(string $query)
    {
        $stm = self::$conn->prepare($query);
        return $stm->execute();
    }

}