<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Helper_Url
{

    /**
     * Return URL on current site with path and query
     *
     * @param   array   $query
     * @param   string  $base
     * @return  string
     */
    public static function create(array $args = array(), $base = '')
    {
        return 'http://' . $_SERVER['SERVER_NAME'] . ( empty($base) ? '/?' : $base ) . http_build_query( $args );
    }

    /**
     * Create anchor
     *
     * @param string    $url
     * @param string    $text
     * @param array     $params
     * @return string
     */
    public static function anchor($url, $text, array $params = array())
    {
        $props = '';
        foreach ($params as $key => $value)
        {
            $props .= ' "' . $key . '"="' . $value . '" ';
        }

        return '<a href="' . $url . '"' . $props. '>' . $text . '</a>';
    }
}
