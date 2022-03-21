<?php

namespace App\Demo\Validator;

class UserValidator implements ValidatorInterface {

    public static function validate($params)
    {   $message = array();
        if(!array_key_exists('name', $params )) {
            $message[] = "Campo nome e obrigatorio!";
        }

        if(!array_key_exists('email', $params )) {
            $message[] = "Campo email e obrigatorio!";
        }

        if(!array_key_exists('address', $params )) {
            $message[] = "Campo address e obrigatorio!";
        }

        if(!empty($message)) {
            return $message;
        }

        return false;
    }
}