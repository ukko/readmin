<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Helper_Auth
{
    public static function auth()
    {
        session_start();

        $users = Config::get('users');

        $login      = filter_input(INPUT_POST, 'login' );
        $password   = filter_input(INPUT_POST, 'password' );
        $server     = filter_input(INPUT_POST, 'server');

        $isAuth     = false;

        if ( isset( $_SESSION['login'] ) && isset( $_SESSION['password'] ) && isset( $users[ $_SESSION['login'] ] ) )
        {
            if ( $_SESSION['password'] == $users[ $_SESSION['login'] ] )
            {
                $isAuth = true;
            }
        }

        if ( ! $isAuth && $login && $password )
        {
            if ( isset( $users[ $login ] ) && $users[ $login ] == sha1( $password ) )
            {
                $_SESSION['login']      = $login;
                $_SESSION['password']   = sha1( $password );

                $server                 = explode(':', $server);
                $host                   = isset($server[0]) ? $server[0] : NULL;
                $port                   = isset($server[1]) ? $server[1] : NULL;

                $_SESSION['host']       = $host;
                $_SESSION['port']       = $port;

                return true;
            }
        }


        if ( ! $isAuth )
        {
            header('HTTP/1.0 401 Unauthorized');
            die( View::factory('login') );
        }
    }

    public static function logout()
    {
        session_destroy();
        setcookie (session_name(), "", time() - 86400);
        header('Location: /');
        exit();
    }
}
