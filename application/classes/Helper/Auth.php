<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Helper_Auth
{
    /**
     * Login user
     */
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
            if ( isset( $hosts[ $server ]['users'][ $login ] ) )
            {
                $role = $hosts[ $server ]['users'][ $login ];
            }
            else
            {
                $role = NULL;
            }

            if ( isset( $users[ $login ] ) && $users[ $login ] == sha1( $password ) && $role )
            {
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

    /**
     * Logout current session
     */
    public static function logout()
    {
        session_destroy();
        header('Location: /');
        exit();
    }

    public static function login()
    {
        $host    = filter_input( INPUT_GET, 'host', FILTER_SANITIZE_STRING );

        $users      = Config::get('users');
        $hosts      = Config::get('hosts');

        if ( isset( $_SESSION['login'] ) && isset( $_SESSION['password'] ) && isset( $users[ $_SESSION['login'] ] ) )
        {
            if ( isset( $hosts[ $host ]['users'][ $_SESSION['login'] ] ) )
            {
                $role = $hosts[ $host ]['users'][ $_SESSION['login'] ];
            }
            else
            {
                $role = NULL;
            }

            if ( $_SESSION['password'] == $users[ $_SESSION['login'] ] && $role )
            {
                $server                 = explode( ':', $host );
                $host                   = isset($server[0]) ? $server[0] : NULL;
                $port                   = isset($server[1]) ? $server[1] : NULL;

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
        self::logout();
    }

    /**
     * Check is current host
     *
     * @param   string  $host   192.168.2.1:6379
     * @return  bool
     */
    public static function isCurrentHost( $host )
    {
        $data = Config::get('hosts', $host );
        return ( isset($data['users'][ $_SESSION['login'] ] ) && ( Config::get('host') . ':' . Config::get('port') == $host ) );
    }

    /**
     * Return alias (if exist) host, else simple host
     *
     * @param   string  $host       127.0.0.1:6379
     * @param   bool    $withUser
     * @return  string  localhost   localhost
     */
    public static function aliasHost( $host, $withUser = false )
    {
        $user = ( isset($_SESSION['login']) ? $_SESSION['login'] : '');
        $data = Config::get('hosts', $host );
        $host = ! empty( $data['name'] ) ? $data['name'] : $host;

        return ( $withUser || ! empty($user) ? ($user . '@') : '') . $host;
    }

    /**
     * Anchor on change host
     *
     * @param   string  $host
     * @return  string
     */
    public static function anchorHost( $host )
    {
        return '<a href="/index/login?host=' . urlencode($host) . '" title="' . htmlspecialchars($host) . '">' . self::aliasHost($host) . '</a>';
    }
}
