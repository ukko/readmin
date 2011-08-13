<?php

class Config 
{
    static $config = NULL;
    
    public static function factory() 
    {
        if ( ! self::$config) {
            self::$config = include APPPATH . '/config.php';
        }
        return self::$config; 
    }
    
    public static function get($key)
    {
        $config = self::factory();
        return $config[$key];
    }
}