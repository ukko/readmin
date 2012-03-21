<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Command_Sets
{
    public static function sMembers( $key )
    {
        return R::factory()->sMembers( $key );
    }

    public static function sRem( $key, $member )
    {
        return R::factory()->sRem( $key, $member );
    }
}
