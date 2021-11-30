<?php

namespace App\Demo\Util;

class Env {

    public static function getPathFileEnv()
    {
        $filename = __DIR__. '/../../.env';
        return  $filename;
    }

    public static function load()
    {
        $arr = [];
        $filename = self::getPathFileEnv();

        if(!file_exists($filename ))
            throw new \Exception('File .env not found');

        $file = fopen($filename , "r");
        while(! feof($file)) {
            $line = fgets($file);
            if(strlen(trim($line))> 1) {
                $line = str_replace('"','',$line);
                $temp = explode("=",$line);
                $arr[trim($temp[0])] = trim($temp[1]);
            }
        }
        fclose($file);
        return $arr;
    }
}


?>