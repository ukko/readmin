<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
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

    public static function hGet( $key, $field )
    {
        return R::factory()->hGet( $key, $field );
    }

    public static function hSet( $key, $field, $value )
    {
        return R::factory()->hSet( $key, $field, $value );
    }
}
