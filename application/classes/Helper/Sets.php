<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Helper_Sets
{

    public static function anchorActionDelete( $key, $member )
    {
        $params = array(
            'db'    => Request::factory()->getDb(),
            'cmd'   => 'SREM ' . $key . ' ' . $member,
            'back'  => Request::factory()->getBack(),
        );

        $url    = 'http://' . Request::factory()->getServerName() . '/?' . http_build_query( $params );
        $title  = 'SREM ' . htmlspecialchars( $key . ' ' . $member );

        return '<a class="cmd delete" href="' . $url . '" title="' . $title . '"><i class="icon-trash"></i> Delete</a>';
    }
}
