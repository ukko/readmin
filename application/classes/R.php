<?php
/**
 * Redis factory
 *
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
                throw $e;
            }
        }

        return self::$instance;
    }
}
