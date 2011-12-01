<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Command_Sets
{
    public static function smembers( $key )
    {
        $value = R::factory()->sMembers( $key );

        $data = array(
                        'key'   => $key,
                        'value' => $value,
                    );
        return View::factory('tables/smembers', $data);
    }
}
