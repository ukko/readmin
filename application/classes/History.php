<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class History
{
    /**
     * Write command to
     *
     * @param string $user
     * @param string $command
     * @return void
     */
    public static function write( $user = '', $command = '' )
    {
        $key        = Config::get('re_prefix') . 'log:' . sha1( $user );
        $command    = trim( $command );

        if ( R::factory()->lIndex( $key, -1 ) != $command )
        {
            return R::factory()->rPush( $key, $command );
        }
        else
        {
            return false;
        }
    }

    public static function getLast( $user )
    {
        $key        = Config::get('re_prefix') . 'log:' . sha1( $user );
        $history    =  array();
        $uniq       = array();
        foreach (R::factory()->lRange( $key, -100, -1 ) as $h )
        {
            if ( ! in_array( $h, $uniq ) )
            {
                $uniq[]  = $h;
                $history[] = array( 'value' => $h, 'desc' => '' );
            }
        }
        return $history;
    }

    public static function getUrl( $user )
    {
        $key        = Config::get('re_prefix') . 'log:' . sha1( $user );
        $args       = array(
            'cmd'       => 'LRANGE ' . $key . ' 0 ' . $_SESSION['limit'],
            'db'        => Request::factory()->getDb(),
        );

        return 'http://' . Request::factory()->getServerName() .'/?'. http_build_query( $args);
    }
}
