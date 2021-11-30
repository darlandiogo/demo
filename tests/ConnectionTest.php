<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Demo\Database\ConnectionFactory;
use App\Demo\Database\QueryBuilder;

final class ConnectionTest extends TestCase
{
    public function testCreateConnection(): void {
        $this->assertInstanceOf(\PDO::class, ConnectionFactory::create());
    }

    public function testCreateQueryBuilderInstance() : void {
        $this->assertInstanceOf(QueryBuilder::class, ConnectionFactory::getConnection());
    }
        
}
