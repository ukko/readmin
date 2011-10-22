<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ukko
 * Date: 22.10.11
 * Time: 4:07
 * To change this template use File | Settings | File Templates.
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
