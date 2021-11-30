<?php

namespace App\Demo\Entity;

use App\Demo\Entity\EntityInterface;

class UserEntity implements EntityInterface {

    public $id;
    public $name;
    public $email;
    public $address;

    public function getId() : string {
        return $this->id;
    }

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function getName() : string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getAddress() : string {
        return $this->address;
    }

    public function setAddress(string $address) : void {
        $this->address = $address;
    }

    public static function factory(array $params): UserEntity {
        $userEntity = new UserEntity();

        if(isset($params["id"]))
            $userEntity->setId($params["id"]);

        $userEntity->setName($params["name"]);
        $userEntity->setEmail($params["email"]);
        $userEntity->setAddress($params["address"]);
        return $userEntity;
    }

}