<?php
/**
 *
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

    /**
     * Get string value
     *
     * @param $key
     * @return void
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

    public function hdel( $key, $field )
    {
        Command_Hashes::hDel( $key, $field );

        return Helper_Navigation::goBack( $this );
    }

    public function smembers( $key )
    {
        return Command_Sets::smembers( $key );
    }

    public function zrange( $key, $start = 0, $end = -1 )
    {
        return Command_ZSets::zrange( $key, $start, $end );
    }

    public function lrange( $key, $start = 0, $end = -1 )
    {
        return Command_Lists::lrange( $key, $start, $end );
    }

    public function del($args)
    {
        Command_Keys::del( urldecode($args) );

        return Helper_Navigation::goBack( $this );
    }

    public function info()
    {
        $info = R::factory()->info();
        $this->table = View::factory('tables/info', array('items' => $info));
    }

    public function ping()
    {
        $ping = R::factory()->ping();
        $this->notice = View::factory('tables/ping', array('ping' => $ping));
    }
}
