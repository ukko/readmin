<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Command_Strings
{
	public static function get( $key )
	{
        return R::factory()->get( $key );
	}

    public static function set( $key, $value )
    {
        return R::factory()->set( $key, $value );
    }
}
