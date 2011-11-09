<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ukko
 * Date: 05.11.11
 * Time: 0:36
 * To change this template use File | Settings | File Templates.
 */

class Helper_Hashes
{

    public static function anchorActionDelete( $key, $field )
    {
        $params = array(
            'db'    => Request::factory()->getDb(),
            'cmd'   => 'HDEL ' . urlencode( $key ) . ' ' . urlencode( $field ),
            'back'  => Request::factory()->getBack(),
        );

        $url    = 'http://' . Request::factory()->getServerName() . '/?' . http_build_query( $params );
        $title  = 'HDEL ' . htmlspecialchars($key) . ' ' . htmlspecialchars($field);

        return '<a class="cmd delete" href="' . $url . '" title="' . $title . '">Delete</a>';
    }
}
