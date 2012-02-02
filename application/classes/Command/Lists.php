<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Command_Lists
{
    public static function lRange( $key, $start = 0, $end = -1 )
    {
        $value = R::factory()->lrange( $key, $start, $end );

        $data = array(
                        'key'       => $key,
                        'start'     => $start,
                        'end'       => $end,
                        'value'     => $value,
			            'paginator' => '',
                    );

	    $total = R::factory()->lLen( $key );

        if ( $total > Config::get('re_limit') )
        {
            $dataUrl = array(
                                'db'    => Request::factory()->getDb(),
                                'cmd'   => 'LRANGE ' . $key,
                            );

            $url    = '/?'. http_build_query( $dataUrl ) . '+:start:+:end:+&page=:page:';
            $data['command']    = 'LRANGE ' . $start . ' ' . $end;
            $data['paginator'] = Paginator::parseExtended(
                                    $total, Request::factory()->getPage(), $url, Config::get( 're_pages' )
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
