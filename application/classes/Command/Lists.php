<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ukko
 * Date: 22.10.11
 * Time: 4:12
 * To change this template use File | Settings | File Templates.
 */

class Command_Lists
{
    public static function lRange( $key, $start = 0, $end = -1 )
    {
        $value = R::factory()->lrange( $key, $start, $end );

        $data = array(
                        'key'   => $key,
                        'start' => $start,
                        'end'   => $end,
                        'value' => $value,
			'paginator'  => '',
                    );

	$total = R::factory()->lLen( $key );
 
        if ( $total > Config::get('re_limit') )
        {

            $dataUrl = array(
                            'db'        => Request::factory()->getDb(),
                            'cmd'       => 'LRANGE ' . $key,
                            );

            $url    = '/?'. http_build_query( $dataUrl ) . '+:start:+:end:+&page=:page:';
            $data['paginator'] = Paginator::parseExtended(
                                    $total, Request::factory()->getPage(), $url, Config::get( 're_limit' )
                                );
        }

        return View::factory('tables/lrange', $data);
    }

    public static function lRem( $key, $count, $value )
    {
        // @XXX WARNING, please note the order of arguments
        return R::factory()->lRem( $key, $value, (int) $count );
    }
}
