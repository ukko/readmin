<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class View
{
    protected static $params = array();

    public static function setParam($name, $value)
    {
        self::$params[ $name ] = $value;
    }

    public static function getParam( $name )
    {
        if ( isset( self::$params[ $name ] ) )
        {
            return self::$params[ $name ];
        }
        else
        {
            return null;
        }
    }

    public static function cleanParams( $name = null )
    {
        if ( $name )
        {
            unset( self::$params[ $name ] );
        }
        else
        {
            self::$params = array();
        }
    }

    public static function ajax( $args = array() )
    {
        self::$params += $args;
        header('Content-Type: application/json');
        echo json_encode( self::$params );
    }

    /**
     * Parse view
     *
     * @param string    $view
     * @param array     $args
     * @return void
     */
    public static function factory( $view, array $args = array() )
    {
        $content = '';
        $file = APPPATH . '/view/' . $view . '.php';
        self::$params += $args;

        if ( file_exists( $file ) )
        {
            extract(self::$params);

            ob_start();
            include $file;
            return ob_get_clean();
        }
        else
        {
            throw new ExceptionView('File not found: "' . $view . '"');
        }
    }
}
