<?php

class Helper_Lists
{

    public static function anchorActionDelete( $key, $member )
    {
        $params = array(
            'db'    => Request::factory()->getDb(),
            'cmd'   => 'LREM ' . urlencode( $key ) . ' 0 ' . urlencode( $member ),
            'back'  => Request::factory()->getBack(),
        );

        $url    = 'http://' . Request::factory()->getServerName() . '/?' . http_build_query( $params );
        $title  = 'LREM ' . htmlspecialchars( $key ) . ' 0 ' . htmlspecialchars( $member );

        return '<a class="cmd delete" href="' . $url . '" title="' . $title . '">Delete</a>';
    }
}
