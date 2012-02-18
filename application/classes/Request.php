<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Request
{
    protected $url          = null;
    protected $method       = null;
    protected $referrer     = null;
    protected $ip           = null;
    protected $ajax         = null;
    protected $scheme       = null;
    protected $userAgent    = null;
    protected $db           = null;
    protected $cmd          = null;
    protected $serverName   = null;
    protected $page         = null;
    protected $limit        = null;

    protected $back         = null;

    protected static $instance = null;

    private function __construct() {}

    private function before()
    {
        $dbOptions = array (
            'options' => array (
                'default'   => Config::get('re_db'),
                'min_range' => 0,
                'max_range' => 1000,
            )
        );

        $pageOptions    = array(
            'options' => array (
                'default'   => 1,
                'min_range' => 1,
            )
        );

        $this->setUrl(      filter_input( INPUT_SERVER,     'REQUEST_URI', FILTER_SANITIZE_URL ) );
        $this->setMethod(   filter_input( INPUT_SERVER,     'REQUEST_METHOD', FILTER_SANITIZE_STRING ) );
        $this->setReferrer( filter_input( INPUT_SERVER,     'HTTP_REFERER', FILTER_SANITIZE_URL ) );
        $this->setIp(       filter_input( INPUT_SERVER,     'REMOTE_ADDR', FILTER_SANITIZE_STRING ) );

        $this->setScheme(   filter_input( INPUT_SERVER,     'SERVER_PROTOCOL', FILTER_SANITIZE_STRING ) );
        $this->setUserAgent( filter_input( INPUT_SERVER,    'HTTP_USER_AGENT', FILTER_SANITIZE_STRING ) );
        $this->setServerName( filter_input( INPUT_SERVER,   'SERVER_NAME' ) );
        $this->setAjax(     filter_input( INPUT_SERVER,     'HTTP_X_REQUESTED_WITH',
                                                                FILTER_SANITIZE_STRING ) == 'XMLHttpRequest' );

        if ( isset( $_POST['cmd'] ) )
        {
            $this->setCmd( filter_input( INPUT_POST, 'cmd', FILTER_SANITIZE_STRING ) );
        }
        else
        {
            $this->setCmd( filter_input( INPUT_GET, 'cmd', FILTER_SANITIZE_STRING ) );
        }

        if ( isset( $_POST['db'] ) )
        {
            $this->setDb( filter_input( INPUT_POST, 'db', FILTER_VALIDATE_INT, $dbOptions ) );
        }
        else
        {
            $this->setDb( filter_input( INPUT_GET, 'db', FILTER_VALIDATE_INT, $dbOptions ) );
        }

        if ( isset( $_POST['page'] ) )
        {
            $this->setPage( filter_input( INPUT_POST, 'page', FILTER_VALIDATE_INT, $pageOptions ) );
        }
        else
        {
            $this->setPage( filter_input( INPUT_GET, 'page', FILTER_VALIDATE_INT, $pageOptions ) );
        }

        if ( isset( $_POST['back'] ) )
        {
            $this->setBack( filter_input( INPUT_POST, 'back', FILTER_SANITIZE_STRING ) );
        }
        else
        {
            $this->setBack( filter_input( INPUT_GET, 'back', FILTER_SANITIZE_STRING ) );
        }

        if ( isset( $_POST['limit'] ) )
        {
            $limit = filter_input( INPUT_POST, 'limit', FILTER_VALIDATE_INT );
        }
        else
        {
            $limit = filter_input( INPUT_GET, 'limit', FILTER_VALIDATE_INT ) ;
        }

        if ( ! $limit )
        {
            $limit = Config::get( 're_limit' );
        }
        Config::set( 're_limit', $limit );
    }

    /**
     * Return Request instance
     * @return Request
     */
    public static function factory()
    {
        if ( ! self::$instance )
        {
            self::$instance = new Request;
            self::$instance->before();
        }

        return self::$instance;
    }

    public function setAjax($ajax)
    {
        $this->ajax = $ajax;
    }

    public function getAjax()
    {
        return $this->ajax;
    }

    public function setCmd($cmd)
    {
        $this->cmd = $cmd;
    }

    public function getCmd()
    {
        return $this->cmd;
    }

    public function setDb($db)
    {
        $this->db = $db;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setReferrer($referrer)
    {
        $this->referrer = $referrer;
    }

    public function getReferrer()
    {
        return $this->referrer;
    }

    public function setScheme($scheme)
    {
        $this->scheme = $scheme;
    }

    public function getScheme()
    {
        return $this->scheme;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function setBack( $back )
    {
        if ( ! $back )
        {
            return $this->back = "INFO";
        }

        $back = urldecode($back);

        $action = explode(' ', $back);
        $action = strtoupper( $action[0] );

        if ( in_array($action, array('KEYS', 'HGETALL', 'ZRANGE', 'LRANGE')) )
        {
            return $this->back = $back;
        }
    }

    public function getBack()
    {
        return $this->back;
    }

    public function setServerName($serverName)
    {
        $this->serverName = $serverName;
    }

    public function getServerName()
    {
        return $this->serverName;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    public function getLimit()
    {
        return $this->limit;
    }
}
