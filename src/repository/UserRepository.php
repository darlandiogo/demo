<?php

namespace App\Demo\Repository;

use App\Demo\Repository\RepositoryInterface;
use App\Demo\Entity\UserEntity;
use App\Demo\Database\ConnectionFactory;

class UserRepository implements RepositoryInterface {

    public static function list() : array
    {
        $arr = []; 
        $queryBiulder = ConnectionFactory::getConnection();
        $results = $queryBiulder->select('select * from users;');
        foreach( $results as $result ) {
            $userEntity = UserEntity::factory($result);
            array_push($arr, $userEntity);
        }   
        return $arr;
    }

    public static function getUserById(int $id): ?UserEntity
    {
        $queryBiulder = ConnectionFactory::getConnection();
        $results = $queryBiulder->select("select * from users where id = $id ; ");
        $result  = $results->current();
        if(is_null($result)) return null;
        return UserEntity::factory($result);
    }

    public static function create ( array $params ) : bool
    {
        $userEntity = UserEntity::factory($params);

        $queryBiulder = ConnectionFactory::getConnection();
        $query  = " insert into users (name, email, address) values ('".$userEntity->getName()."', '".$userEntity->getEmail()."', '".$userEntity->getAddress()."'); ";
        $result = $queryBiulder->query($query);
        if($result) return true;
        return false;
    }

    public static function edit(int $id, array $params) : bool
    {
        $userEntity = self::getUserById($id);
        if(empty($userEntity)) return false;

        $userEntity->setName($params["name"]);
        $userEntity->setEmail($params["email"]);
        $userEntity->setAddress($params["address"]); 

        $queryBiulder = ConnectionFactory::getConnection();
        $query  = " update users set name = '".$userEntity->getName()."' , email = '".$userEntity->getEmail()."', address= '".$userEntity->getAddress()."' where id = $id ; ";
        $result = $queryBiulder->query($query);
        if($result) return true;
        return false;

    }

    public static function delete(int $id)
    {
        $queryBiulder = ConnectionFactory::getConnection();
        $query  = " delete from users where id = $id ; ";
        $result = $queryBiulder->delete($query);
        if($result) return true;
        return false;
    }

}