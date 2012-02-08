<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Controller_Command extends Controller_Base
{
    /**
     * Display keys
     *
     * @param   $args
     * @return  void
     */
    public function keys($args)
    {
        Request::factory()->setBack( urlencode( 'KEYS ' . $args ) );
        return Command_Keys::keys( $args );
    }

    public function expire( $args )
    {
        $key    = '';
        $ttl    = 0;

        $args = explode(' ', $args);
        if ( count($args) >= 2 )
        {
            $key    = $args[0];
            $ttl    = (int)$args[1];
        }

        Command_Keys::expire( $key, $ttl );
        return Helper_Navigation::goBack( $this );
    }

    public function expireat( $args )
    {
        $key            = '';
        $timestamp      = 0;

        $args = explode(' ', $args);
        if ( count($args) >= 2 )
        {
            $key        = $args[0];
            $timestamp  = (int)$args[1];
        }

        Command_Keys::expireAt( $key, (int)$timestamp );
        return Helper_Navigation::goBack( $this );
    }

    public function persist( $key )
    {
        Command_Keys::persist( $key );
        return Helper_Navigation::goBack( $this );
    }

    public function randomkey()
    {
        return Command_Keys::randomKey();
    }

    public function ttl( $key )
    {
        return Command_Keys::ttl( $key );
    }

    public function rename( $args )
    {
        $key        = '';
        $newKey     = '';

        $args = explode(' ', $args);
        if ( count($args) >= 2 )
        {
            $key        = $args[0];
            $newKey     = $args[1];
        }

        Command_Keys::rename( $key, $newKey );
        return Helper_Navigation::goBack( $this );
    }

    public function move( $args )
    {
        $key        = '';
        $db         = 0;

        $args = explode(' ', $args);
        if ( count($args) >= 2 )
        {
            $key        = $args[0];
            $db         = (int)$args[1];
        }

        Command_Keys::move( $key, $db );
        return Helper_Navigation::goBack( $this );
    }

    /**
     * Get string value
     *
     * @param $key
     * @return string
     */
    public function get( $key )
    {
        return Command_Strings::get( $key );
    }

    public function hgetall( $key )
    {
        Request::factory()->setBack( urlencode( 'HGETALL ' . $key ) );

        return Command_Hashes::hGetAll( $key );
    }

    public function hdel( $args )
    {
        $key        = '';
        $field      = '';

        $args = explode(' ', $args);
        if ( count($args) >= 2 )
        {
            $key        = $args[0];
            $field      = $args[1];
        }

        Command_Hashes::hDel( $key, $field );

        return Helper_Navigation::goBack( $this );
    }

    public function smembers( $key )
    {
        return Command_Sets::smembers( $key );
    }

    public function zrange( $args )
    {
        $key        = '';
        $start      = 0;
        $end        = -1;

        $args = explode(' ', $args);
        if ( count($args) >= 3 )
        {
            $key        = $args[0];
            $start      = (int)$args[1];
            $end        = (int)$args[2];
        }

        Request::factory()->setBack( urlencode( 'ZRANGE ' . $key . ' ' . $start . ' ' . $end ) );
        return Command_ZSets::zrange( $key, $start, $end );
    }

    public function zRangeByScore( $args )
    {
        $args = explode(' ', $args);

        if ( count($args) > 3 ) {
            $key        = $args[0];
            $min        = in_array(strtolower($args[1]), array('-inf', '+inf')) ? strtolower($args[1]) : (int)$args[1];
            $max        = in_array(strtolower($args[2]), array('-inf', '+inf')) ? strtolower($args[2]) : (int)$args[2];
        }

        $withscores = FALSE;
        $offset     = 0;
        $limit      = 20;

        $command = 'ZRANGEBYSCORE ' . $key . ' ' . $min . ' ' . $max;
        if ( isset($args[3]) && strtoupper($args[3] == 'WITHSCORES') )
        {
            $withscores = TRUE;
            $command .= ' WITHSCORES ';
        }
        if ( isset($args[3 + $withscores ]) && strtoupper($args[3 + $withscores]) == 'LIMIT' )
        {

            $offset     = (int)$args[4 + $withscores ];
            $limit      = (int)$args[5 + $withscores ];
            $command    .= ' LIMIT ' .  $offset . ' ' . $limit;
        }

        Request::factory()->setBack( urlencode( $command ) );
        return Command_ZSets::zRangeByScore( $key, $min, $max, $limit, $offset );
    }

    public function zrem( $key, $member )
    {
        $key        = '';
        $member     = '';

        $args = explode(' ', $args);
        if ( count($args) >= 2 )
        {
            $key        = $args[0];
            $member      = $args[1];
        }

        Command_ZSets::zRem( $key, $member );

        return Helper_Navigation::goBack( $this );
    }

    public function lrange( $args )
    {
        $key    = '';
        $start  = 0;
        $end    = -1;

        $args = explode(' ', $args);
        if ( count($args) >= 3 )
        {
            $key    = $args[0];
            $start  = (int)$args[1];
            $end    = (int)$args[2];
        }

        Request::factory()->setBack( urlencode( 'LRANGE ' . $key . ' ' . $start . ' ' . $end ) );
        return Command_Lists::lrange( $key, $start, $end );
    }

    public function lrem( $key, $count, $member )
    {
        $key    = '';
        $count  = '';
        $member = '';

        $args = explode(' ', $args);
        if ( count($args) >= 3 )
        {
            $key        = $args[0];
            $count      = (int)$args[1];
            $member     = $args[2];
        }

        Command_Lists::lRem( $key, $count, $member );

        return Helper_Navigation::goBack( $this );
    }

    public function del($args)
    {
        Command_Keys::del( urldecode($args) );

        return Helper_Navigation::goBack( $this );
    }

    public function info()
    {
        $info = R::factory()->info();
        return View::factory('tables/info', array('items' => $info));
    }

    public function ping()
    {
        $ping = R::factory()->ping();
        $this->notice = View::factory('tables/ping', array('ping' => $ping));
    }

}
