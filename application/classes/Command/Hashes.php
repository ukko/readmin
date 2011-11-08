<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ukko
 * Date: 22.10.11
 * Time: 4:05
 * To change this template use File | Settings | File Templates.
 */

class Command_Hashes
{
    public static function hGetAll( $key )
    {
        $value = R::factory()->hGetAll( $key );

        $data = array(
                        'key'   => $key,
                        'value' => $value,
                    );
        return View::factory('tables/hgetall', $data);
    }

    public static function hDel( $key, $field )
    {
        return R::factory()->hDel( $key, $field );
    }
}
