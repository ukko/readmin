<?php

class Command_Keys
{
    public static function keys( $args )
    {
        $lKey = Config::get( 're_prefix' ) . sha1( $args );

        if ( ! R::factory()->exists( $lKey ) )
        {
            foreach ( R::factory()->keys( $args ) as $key )
            {
                R::factory()->rPush( $lKey, $key );
            }
            R::factory()->expire( $lKey, 300 );
        }

        $start  = (Request::factory()->getPage() - 1) * Config::get( 're_limit' );
        $end    = $start + Config::get( 're_limit' );
        $keys   = array();
        foreach ( R::factory()->lRange( $lKey, $start, $end ) as $key )
        {
            $keys[] = array(
                                'key'   => $key,
                                'type'  => Helper_Keys::getType( $key ),
                                'value' => Helper_Keys::getValue( $key, Helper_Keys::getType($key) )
                            );
        }

        $total  = R::factory()->lSize( $lKey );

        $dataUrl = array(
            'cmd'   => Request::factory()->getCmd(),
            'db'    => Request::factory()->getDb(),
        );
        $url    = '/?'. http_build_query( $dataUrl ) . '&page=:id:';
        $paginator = Paginator::parsePaginator( $total, Request::factory()->getPage(), $url, Config::get( 're_limit' ) );

        $data = array(
                        'db'        => Request::factory()->getDb(),
                        'paginator' => $paginator,
                        'keys'      => $keys,
                        'command'   => Request::factory()->getCmd(),
                    );

        return View::factory( 'tables/keys', $data );
    }
}
