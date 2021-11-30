<?php

namespace App\Demo\Util;

class I18n {

    private static $i18n = null;

    private static function getFile($locale) {
        $path =  __DIR__ . "/../I18n/{$locale}/{$locale}.json";
        return file_get_contents( $path );
    }

    private static function load()
    {
        $config = Env::load();

        $locale = $config['I18N_CONFIG_LOCALE'] ?? null;
        if(empty($locale))
            throw new \Exception('Not configured file I18n pattern');

        $str = self::getFile($locale);
        if(empty($str))
            throw new \Exception('File I18n not loaded');
        
        self::$i18n = json_decode( $str, true );
    }

    public static function message(string $key): string
    {
        if(is_null(self::$i18n)) 
            self::load();

        return self::$i18n[$key] ?? null;
    }

}