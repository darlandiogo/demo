<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Demo\Util\Env;

final class EnvTest extends TestCase
{
    public function testExistFileEnv(): void {
        $this->assertFileExists(Env::getPathFileEnv());
    }

    public function testLoadMethodFromEnvClassIsArray(): void {
        $env = Env::load();
        $this->assertIsArray( $env);  
    }

    public function testCannotBeEmptyForLoadMethodFromEnvClass(): void
    {
        $env = Env::load();
        $this->assertContains($env["DB_HOST"], $env);
        $this->assertContains($env["DB_DATABASE"], $env);
        $this->assertContains($env["DB_USERNAME"], $env);
        $this->assertContains($env["DB_PASSWORD"], $env); 
    }
}





