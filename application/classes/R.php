<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 *
 * Redis factory
 * @throws RedisException
 */
class R
{
    /**
     * Instance redis
     *
     * @var Redis
     */
    protected static $instance = null;

    /**
     * Get instance redis
     *
     * @return Redis
     */
    public static function factory()
    {
        if ( ! self::$instance)
        {
            try
            {
                self::$instance = new Redis();
                self::$instance->connect( Config::get('host'), Config::get('port'), Config::get('timeout') );
                self::$instance->select( Request::factory()->getDb() );
            }
            catch ( RedisException $e )
            {
                Helper_Auth::logout();
                throw $e;
            }
        }

        return self::$instance;
    }
}
