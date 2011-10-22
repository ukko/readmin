<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ukko
 * Date: 22.10.11
 * Time: 4:12
 * To change this template use File | Settings | File Templates.
 */

class Command_Lists
{
    public static function lrange( $key, $start = 0, $end = -1 )
    {
       $value = R::factory()->lrange( $key, $start, $end );

        $data = array(
                        'key'   => $key,
                        'value' => $value,
                    );
        return View::factory('tables/lrange', $data);
    }
}
