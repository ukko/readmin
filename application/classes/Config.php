<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
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
