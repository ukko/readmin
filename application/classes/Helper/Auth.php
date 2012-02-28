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

        $users      = Config::get('users');
        $hosts      = Config::get('hosts');

        $login      = filter_input(INPUT_POST, 'login',     FILTER_SANITIZE_STRING );
        $password   = filter_input(INPUT_POST, 'password',  FILTER_SANITIZE_STRING );
        $server     = filter_input(INPUT_POST, 'server',    FILTER_SANITIZE_STRING );

        $isAuth     = false;

        if ( isset( $_SESSION['login'] ) && isset( $_SESSION['password'] ) && isset( $users[ $_SESSION['login'] ] ) )
        {
            if ( $_SESSION['password'] == $users[ $_SESSION['login'] ] )
            {
                $isAuth = true;

                Config::set('host', $_SESSION['host']);
                Config::set('port', $_SESSION['port']);
                Config::set('role', $_SESSION['role']);
            }
        }

        if ( ! $isAuth && $login && $password )
        {
            if ( isset( $hosts[ $server ] [ $login ] ) )
            {
                $role = $hosts[ $server ] [ $login ];
            }
            else
            {
                $role = NULL;
            }

            if ( isset( $users[ $login ] ) && $users[ $login ] == sha1( $password ) && $role )
            {
                $isAuth                 = true;

                $server                 = explode(':', $server);
                $host                   = isset($server[0]) ? $server[0] : NULL;
                $port                   = isset($server[1]) ? $server[1] : NULL;

                $_SESSION['login']      = $login;
                $_SESSION['password']   = sha1( $password );
                $_SESSION['host']       = $host;
                $_SESSION['port']       = $port;
                $_SESSION['role']       = $role;

                Config::set('host', $host);
                Config::set('port', $port);
                Config::set('role', $role);

                header('Location: /');
                exit();
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
        header('Location: /');
        exit();
    }
}
