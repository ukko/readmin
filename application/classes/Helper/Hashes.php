<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
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

        $url    = Helper_Url::create() . '/?' . http_build_query( $params );
        return Helper_Url::anchor($url, '<i class="icon-trash"></i> Delete', array('cmd', 'delete'));
    }

    public static function anchorActionEdit( $key, $field )
    {
        $params = array(
            'db'    => Request::factory()->getDb(),
            'cmd'   => 'HSET ' . $key . ' ' . $field,
            'back'  => Request::factory()->getBack(),
        );

        $url    = 'http://' . Request::factory()->getServerName() . '/?' . http_build_query( $params );
        $title  = 'HSET ' . htmlspecialchars($key) . ' ' . htmlspecialchars($field);

        return '<a class="cmd" href="' . $url . '" title="' . $title . '"><i class="icon-pencil"></i> Edit</a>';
    }
}
