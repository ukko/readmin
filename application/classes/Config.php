<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Config
{
    /**
     * Admin permission: read, write & shutdown ..
     */
    const ACCESS_ADMIN  = 4;

    /**
     * Write permission
     */
    const ACCESS_WRITE  = 2;

    /**
     * Read only user
     */
    const ACCESS_READ   = 1;

    /**
     * None access
     */
    const ACCESS_NONE   = 0;

    static $config = NULL;

    public static function factory()
    {
        if ( ! self::$config)
        {
            self::$config = include APPPATH . '/default_config.php';

            if ( file_exists(APPPATH . '/../config.php') )
            {
                self::$config = array_merge( self::$config, include APPPATH . '/../config.php' );
            }
        }
        return self::$config;
    }

    public static function get( $key, $key2 = NULL )
    {
        $config = self::factory();

        if ( $key2 )
        {
            return $config[$key][$key2];
        }
        else
        {
            return $config[$key];
        }

    }

    public static function set( $key, $value )
    {
        self::factory();
        return self::$config[$key] = $value;
    }
}
