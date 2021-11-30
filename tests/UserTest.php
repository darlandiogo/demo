<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Demo\Repository\UserRepository;
use App\Demo\Database\ConnectionFactory;

final class UserTest extends TestCase
{
    public function testCreateUser() : void {
        $result = UserRepository::create([
            'name' => 'User test',
            'email' => 'teste@test.com',
            'address' => 'Rua xyz 21'
        ]);
        $this->assertTrue($result);
    }

    public function testEditUser() : void {
        $lastInsertId = ( ConnectionFactory::getConnection() )->lastInsertId();
        $result  = UserRepository::edit($lastInsertId, [
            'name' => 'User test update',
            'email' => 'teste@test.com.br',
            'address' => 'Rua xyz 24'
        ]);
        $this->assertTrue($result);
    }

    public function testDeleteUser() : void {
        $lastInsertId = ( ConnectionFactory::getConnection() )->lastInsertId();
        $result  = UserRepository::delete($lastInsertId);
        $this->assertTrue($result);
    }   
}