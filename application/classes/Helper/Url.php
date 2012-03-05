<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Helper_Url
{

    /**
     * Return URL on current site with query
     *
     * @param string $base
     * @param array  $query
     */
	public static function create( $base = '', array $args = array() )
	{
        return 'http://' . $_SERVER['SERVER_NAME'];// .  http_build_query( $args, $base );
	}

    /**
     * Create anchor
     *
     * @param string $url
     * @param string $value
     * @param array $classes
     * @return string
     */
    public static function anchor( $url, $value, array $classes = array() )
    {
        return '<a href="' . $url . '"'
                . ( ! empty( $classes ) ? ' class="' . implode(' ', $classes) . '"' : '' ) . '>' . $value . '</a>';
    }
}
