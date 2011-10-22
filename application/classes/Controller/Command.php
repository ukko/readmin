<?php
/**
 *
 */
class Controller_Command extends Controller_Base
{
    private function bookmark_add( $key )
    {

    }

    private function bookmark_del( $key )
    {

    }


    // KEYS -------------------------

    /**
     * Display keys
     *
     * @param   $args
     * @return  void
     */
    public function keys($args)
    {
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
        return Command_Hashes::hgetall( $key );
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
        $del = R::factory()->del($args);

        $this->notice = 'Delete ' . $del . ' keys';
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
