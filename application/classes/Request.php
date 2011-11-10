<?php
/**
 * Request
 * @author      Max Kamashev <max.kamashev@gmail.com>
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

        $this->setUrl(      filter_input( INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL ) );
        $this->setMethod(   filter_input( INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING ) );
        $this->setReferrer( filter_input( INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_URL ) );
        $this->setIp(       filter_input( INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING ) );
        $this->setAjax(     filter_input( INPUT_SERVER, 'HTTP_X_REQUESTED_WITH', FILTER_SANITIZE_STRING ) == 'XMLHttpRequest' );
        $this->setScheme(   filter_input( INPUT_SERVER, 'SERVER_PROTOCOL', FILTER_SANITIZE_STRING ) );
        $this->setUserAgent( filter_input( INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_STRING ) );

        $this->setCmd(      filter_input( INPUT_GET, 'cmd', FILTER_SANITIZE_STRING ) );
        $this->setDb(       filter_input( INPUT_GET, 'db', FILTER_VALIDATE_INT,   $dbOptions ) );
        $this->setPage(     filter_input( INPUT_GET, 'page', FILTER_VALIDATE_INT, $pageOptions ) );
        $this->setServerName( filter_input( INPUT_SERVER, 'SERVER_NAME' ) );
        $this->setBack(     filter_input( INPUT_GET,    'back', FILTER_SANITIZE_STRING ) );
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

        if ( in_array($action, array('KEYS', 'HGETALL', 'ZRANGE')) )
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
}
