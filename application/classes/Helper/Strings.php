<?php

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
