<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Controller_CommandRaw extends Controller_Base
{
    /**
     * Get string value
     *
     * @param $key
     * @return void
     */
    public function get( $key )
    {
        return Command_Strings::get( $key );
    }

    public function set( $args )
    {
        $args = explode( ' ', $args, 2 );
        if ( count($args) >= 2 )
        {
            $key        = $args[0];
            $data       = $args[1];
        }

        Command_Strings::set( $key, $data );
        return htmlspecialchars( $data );
    }
}
