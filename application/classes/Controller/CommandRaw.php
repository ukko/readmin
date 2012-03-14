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

    public function hGet( $args )
    {
        $args = explode( ' ', $args );
        if ( count($args) >= 2 )
        {
            $key        = $args[0];
            $field      = $args[1];
        }

        return Command_Hashes::hGet( $key, $field );
    }

    public function hSet( $args )
    {
        $args = explode( ' ', $args, 3 );
        if ( count($args) >= 3 )
        {
            $key        = $args[0];
            $field      = $args[1];
            $data       = $args[2];
        }

        Command_Hashes::hSet( $key, $field, $data );

        return htmlspecialchars( $data );
    }

    public function lIndex( $args )
    {
        $args = explode( ' ', $args );
        if ( count($args) >= 2 )
        {
            $key        = $args[0];
            $index      = $args[1];
        }

        return Command_Lists::lIndex( $key, $index );
    }

    public function lSet( $args )
    {
        $args = explode( ' ', $args, 3 );
        if ( count($args) >= 3 )
        {
            $key        = $args[0];
            $index      = $args[1];
            $value      = $args[2];
        }
        Command_Lists::lSet( $key, $index, $value );

        return htmlspecialchars( $value );
    }

}
