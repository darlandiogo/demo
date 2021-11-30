<?php

namespace App\Demo\Controller;

use App\Demo\Controller\ControllerInterface;
use App\Demo\Repository\UserRepository;
use App\Demo\Validator\UserValidator;
use App\Demo\Util\I18n;

class UserController implements ControllerInterface {
    
    public function list($request, $response, $args)
    {
        $collection = UserRepository::list();
        return $response->withJson([ 'result' => $collection ], 200 );
    }

    public function getUserById($request, $response, $args) 
    {
        if(empty($args['id']))
            return $response->withJson(['error' => I18n::message("INPUT_DATA_INVALID")], 400);

        $collection = UserRepository::getUserById($args['id']);
        if( $collection )
            return $response->withJson([ 'result' => $collection ], 200 );

        return $response->withJson([ 'error' => I18n::message("USER_NOT_FOUND")], 404 );
    }

    public function createUser($request, $response, $args)
    {
        $params  = (array)$request->getParsedBody();

        $message = UserValidator::validate($params);
        if($message)
            return $response->withJson([ 'error' => $message ], 400 );

        if(UserRepository::create($params))
            return $response->withJson([ 'result' => "Usuario adicionado com sucesso!"  ], 201 );
        
        return $response->withJson([ 'error' => I18n::message("MESSAGE_ERROR")], 500 ); 
    }

    /**
     * Obs: Content type acepted is application/x-www-form-urlencoded
    */
    public function editUser($request, $response, $args)
    {
        $params  = (array)$request->getParsedBody() ; 

        $message = UserValidator::validate($params);
        if($message)
            return $response->withJson([ 'error' => $message ], 400 );

        if(UserRepository::edit($args['id'], $params))
            return $response->withJson([ 'result' => "Usuario editado com sucesso!" ], 200 );

 
        return $response->withJson([ 'error' => I18n::message("MESSAGE_ERROR")], 500 );
    }

    public function deleteUser($request, $response, $args)
    {
        if(empty($args['id']))
            return $response->withJson(['error' => I18n::message('INPUT_DATA_INVALID')], 400);

        if(UserRepository::delete($args['id']))
            return $response->withJson([ 'result' => "Usuario deletado com sucesso!" ], 200 );
        
        return $response->withJson([ 'error' => I18n::message("MESSAGE_ERROR")], 500 );
    }
       
    public function __invoke($args)
    {
        print_r($args);
    }
}