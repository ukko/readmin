<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Helper_Strings
{

    public static function anchorActionDelete( $key )
    {
        $params = array(
            'db'    => Request::factory()->getDb(),
            'cmd'   => 'DEL ' . urlencode( $key ),
            'back'  => Request::factory()->getBack(),
        );

        $url    = 'http://' . Request::factory()->getServerName() . '/?' . http_build_query( $params );
        $title  = 'DEL ' . htmlspecialchars($key);

        return '<a class="cmd delete" href="' . $url . '" title="' . $title . '">Delete</a>';
    }
}
