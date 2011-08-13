<?php
class R
{
    /**
     * Instance redis
     * @var Redis
     */
    protected static $instance = null;

    /**
     * Get instance redis
     * @return Redis
     */
    public static function factory()
    {
        if ( ! self::$instance) {
            self::$instance = new Redis();
            self::$instance->connect(Config::get('host'), Config::get('port'));
        }

        return self::$instance;
    }
}
