<?php
/**
 *
 */
class Controller_Command extends Controller_Base
{
    /**
     * Current command
     * @var string
     */
    protected $cmd      = NULL;

    protected $table    = NULL;

    protected $notice   = NULL;

    protected $error    = NULL;

    protected $db       = NULL;

    public function action_index()
    {
        $this->cmd          = isset( $_GET['cmd'] )  ? trim($_GET['cmd'])  : NULL;
        $this->db           = isset( $_GET['db'] )   ? (int) $_GET['db']   : Conf::get('re_db');
        $this->page         = isset( $_GET['page'] ) ? (int) $_GET['page'] : 1;

        try
        {
            $args = explode(' ', $this->cmd);
            $command = strtoupper(array_shift($args));

            if ( method_exists($this, $command) )
            {
                R::factory()->select($this->db);
                call_user_func_array(array($this, $command), $args);
            }
            else
            {
                $this->table = View::factory('tables/404');
            }
        }
        catch ( Exception $e )
        {
            $this->table = View::factory( 'tables/exception', array('exception' => $e) );
        }

        $response = array( 'command' => $this->cmd );

        if ( $this->table )
        {
            $response['table'] = $this->table;
        }

        if ( $this->notice )
        {
            $response['notice'] = $this->notice;
        }

        if ( $this->error )
        {
            $response['error'] = $this->error;
        }

        if ( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
        {
            die( json_encode( $response ) );
        }
        else
        {
            return $response['table'];
        }
    }

    private function getType( $key )
    {
        $types = array(
            0 => 'not_found',
            1 => 'string',
            2 => 'set',
            3 => 'list',
            4 => 'zset',
            5 => 'hash',
        );

        $type = (int) R::factory()->type( $key );

        if ( $type >= 0 && $type <= 5 )
        {
            return $types[ $type ];
        }
        else
        {
            return $types[0];
        }
    }

    // KEYS -------------------------

    /**
     * Display keys
     *
     * @param   $args
     * @return  void
     */
    public function keys($args)
    {
        $lKey = Config::get( 're_prefix' ) . sha1( $args );

        if ( ! R::factory()->exists( $lKey ) )
        {
            foreach ( R::factory()->keys( $args ) as $key )
            {
                R::factory()->rPush( $lKey, $key );
            }
            R::factory()->expire( $lKey, 300 );
        }

        $start  = $this->page * Config::get( 're_limit' );
        $end    = $start + Config::get( 're_limit' );
        $keys   = array();
        foreach ( R::factory()->lRange( $lKey, $start, $end ) as $key )
        {
            $keys[] = array(
                            'key'   => $key,
                            'type'  => $this->getType( $key ),
            );
        }
        $total  = R::factory()->lSize( $lKey );

        $dataUrl = array(
            'cmd'   => $this->cmd,
            'db'    => $this->db,
        );
        $url    = '/?'. http_build_query($dataUrl) . '&page=:id:';
        $paginator = Paginator::parsePaginator( $total, $this->page, $url, Config::get( 're_limit' ) );

        $data = array(
                        'paginator' => $paginator,
                        'keys'      => $keys,
                        'command'   => $this->cmd
                    );

        $this->table = View::factory( 'tables/keys', $data );
    }

    /**
     * Get string value
     *
     * @param $key
     * @return void
     */
    public function get( $key )
    {
        $value = R::factory()->get( $key );
        $this->table = View::factory('tables/get', array('key' => $key, 'value' => $value));

    }

    public function hgetall( $key )
    {
        $value = R::factory()->hGetAll( $key );

        $data = array(
                        'key'   => $key,
                        'value' => $value,
                    );
        $this->table = View::factory('tables/hgetall', $data);
    }

    public function smembers( $key )
    {
        $value = R::factory()->sMembers( $key );

        $data = array(
                        'key'   => $key,
                        'value' => $value,
                    );
        $this->table = View::factory('tables/smembers', $data);
    }

    public function zrange( $key, $start = 0, $end = -1 )
    {
       $value = R::factory()->zRange( $key, $start, $end, true );

        $data = array(
                        'key'   => $key,
                        'value' => $value,
                    );
        $this->table = View::factory('tables/zrange', $data);
    }

    public function lrange( $key, $start = 0, $end = -1 )
    {
       $value = R::factory()->lrange( $key, $start, $end );

        $data = array(
                        'key'   => $key,
                        'value' => $value,
                    );
        $this->table = View::factory('tables/lrange', $data);
    }

    public function del($args)
    {
        $del = R::factory()->del($args);

        $this->notice = 'Delete ' . $del . ' keys';
    }



    public function info()
    {
        $info = R::factory()->info();
        $this->table = View::factory('tables/info', array('items' => $info));
    }

    public function ping()
    {
        $ping = R::factory()->ping();
        $this->notice = View::factory('tables/ping', array('ping' => $ping));
    }
}
