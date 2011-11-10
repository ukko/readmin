<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ukko
 * Date: 22.10.11
 * Time: 4:09
 * To change this template use File | Settings | File Templates.
 */

class Command_ZSets
{
    public static function zRange( $key, $start = 0, $end = -1 )
    {
        $total = R::factory()->zCard( $key );

        $value = R::factory()->zRange( $key, $start, $end, true );

        $data = array(
                        'key'   => $key,
                        'value' => $value,
                    );

        $data['paginator']  = '';

        if ( $total > Config::get('re_limit') )
        {
            $cmd = 'ZRANGE ' . $key . ' ' . ($start + Config::get('re_limit')) . ' ' . ($end + Config::get('re_limit'));
            $dataUrl = array(
                            'db'    => Request::factory()->getDb(),
                            'cmd'   => $cmd,
                            );

            $url    = '/?'. http_build_query( $dataUrl ) . '&page=:id:';
            $data['paginator'] = Paginator::parsePaginator(
                                    $total, Request::factory()->getPage(), $url, Config::get( 're_limit' ) );
        }

        return View::factory('tables/zrange', $data);
    }

    public static function zRem( $key, $member )
    {
        return R::factory()->zRem( $key, $member );
    }
}
