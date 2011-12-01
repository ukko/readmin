<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Helper_ZSets
{
    public static function anchorActionDelete( $key, $member )
    {
        $params = array(
            'db'    => Request::factory()->getDb(),
            'cmd'   => 'ZREM ' . urlencode( $key ) . ' ' . urlencode( $member ),
            'back'  => Request::factory()->getBack(),
        );

        $url    = 'http://' . Request::factory()->getServerName() . '/?' . http_build_query( $params );
        $title  = 'ZREM ' . htmlspecialchars( $key ) . ' ' . htmlspecialchars( $member );

        return '<a class="cmd delete" href="' . $url . '" title="' . $title . '">Delete</a>';
    }
}
