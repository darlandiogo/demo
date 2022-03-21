<?php

error_reporting(E_ALL);

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Slim\Factory\AppFactory;

require_once __DIR__ . "/../vendor/autoload.php";

try {

    $logger = new Logger('my_logger');
    $logger->pushHandler(new StreamHandler(__DIR__.'/logs/app.log', Logger::DEBUG));
    $logger->pushHandler(new FirePHPHandler());

    $app = AppFactory::create();
    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();

    $app->get('/users', [App\Demo\Controller\UserController::class ,  'list']);
    $app->get('/user/{id}', [App\Demo\Controller\UserController::class , 'getUserById']);
    $app->post('/user/create', [App\Demo\Controller\UserController::class , 'createUser']);
    $app->put('/user/edit/{id}', [App\Demo\Controller\UserController::class , 'editUser']);
    $app->delete('/user/{id}', [App\Demo\Controller\UserController::class , 'deleteUser']);

    $app->run();

} catch (Exception $e) {
    $logger->warning( "Message: ". $e->getMessage() . " -- Trace: ". $e->getTraceAsString() );
}
