<?php

class Command_Keys
{
    /**
     * Returns a list of keys matching the pattern
     *
     * @param   string $pattern
     * @return  string
     */
    public static function keys( $pattern )
    {
        if ( is_array( $pattern ) )
        {
            $pattern = implode(' ', $pattern);
        }

        $lKey = Config::get( 're_prefix' ) . 'keys:' . sha1( $pattern );

        if ( ! R::factory()->exists( $lKey ) )
        {
            foreach ( R::factory()->keys( $pattern ) as $key )
            {
                R::factory()->rPush( $lKey, $key );
            }
            R::factory()->expire( $lKey, Config::get('re_store_time') );
        }

        $start      = (Request::factory()->getPage() - 1) * Config::get( 're_limit' );
        $end        = $start + Config::get( 're_limit' );
        $keys       = array();
        foreach ( R::factory()->lRange( $lKey, $start, $end ) as $key )
        {
            $keys[] = array(
                                'key'   => $key,
                                'type'  => Helper_Keys::getType( $key ),
                                'value' => Helper_Keys::getValue( $key, Helper_Keys::getType($key) )
                            );
        }

        $total      = R::factory()->lSize( $lKey );

        $dataUrl = array(
            'cmd'   => Request::factory()->getCmd(),
            'db'    => Request::factory()->getDb(),
        );
        $url        = '/?'. http_build_query( $dataUrl ) . '&page=:id:';
        $paginator  = Paginator::parsePaginator( $total, Request::factory()->getPage(), $url, Config::get( 're_limit' ) );

        $data = array(
                        'db'        => Request::factory()->getDb(),
                        'paginator' => $paginator,
                        'keys'      => $keys,
                        'cmd'       => Request::factory()->getCmd(),
                    );

        return View::factory( 'tables/keys', $data );
    }

    /**
     * @param $key
     * @return int
     */
    public static function del( $key )
    {
        return R::factory()->del( $key );
    }
}
