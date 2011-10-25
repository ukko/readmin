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
        $back = filter_input( INPUT_GET, 'back', FILTER_SANITIZE_STRING );

        Command_Keys::del( urldecode($args) );

        if ( $back )
        {
            $args = explode(' ', $back);
            $action = array_shift( $args );

            if ( method_exists( $this, $action ) )
            {
                Request::factory()->setCmd( $back );
                if (is_array($back))
                {
                    return call_user_func_array(array( $this, $action ), $back);
                }
                else
                {
                    return call_user_func(array( $this, $action ), $back);
                }
            }
        }

        return $this->info();
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
