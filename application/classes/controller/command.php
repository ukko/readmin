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
        $options    = array(
            'options' => array (
                'default'   => Config::get('re_db'),
                'min_range' => 0,
                'max_range' => 1000,
            )
        );
        $this->cmd  = filter_input( INPUT_GET, 'cmd');
        $this->db   = filter_input( INPUT_GET, 'db', FILTER_VALIDATE_INT,   $options );

        $options    = array(
            'options' => array (
                'default'   => 1,
                'min_range' => 1,
            )
        );
        $this->page = filter_input( INPUT_GET, 'page', FILTER_VALIDATE_INT, $options );

//        $commands = array(
//            'keys' => array(
//                'info'      => 'Find all keys matching the given pattern',
//                'pattern'   => 'KEYS *',
//            ),
//        );

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

    private function bookmark_add( $key )
    {

    }

    private function bookmark_del( $key )
    {

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

    public function getValue( $key, $type )
    {
        $size   = 0;
        $value  = ' ';
        $max    = 120;

        if ( $type == 'string' )
        {
            $size = R::factory()->strlen( $key );
            $value = R::factory()->getRange( $key, 0, $max );
            if (strlen($value) > $size)
            {
                $value .= '..';
            }
        }
        elseif ( $type == 'set' )
        {
            $size = R::factory()->sCard( $key );
            $value = '';
            foreach ( R::factory()->sMembers( $key ) as $member )
            {
                if ( strlen( $value ) < ($max - 5) )
                {
                    if ( ! empty($value) )
                    {
                        $value .= ', ';
                    }
                    $value .= $member;
                } else {
                    $value .= ', ..';
                    break;
                }
            }
            $value = '[ ' . $value . ' ]';
        }
        elseif ( $type == 'zset' )
        {
            $size = R::factory()->zCard( $key );
            $value = '';
            foreach ( R::factory()->zRange( $key, 0, 100, true ) as $score => $item )
            {
                if ( strlen( $value ) < ($max - 5) )
                {
                    if ( ! empty($value) )
                    {
                        $value .= ', ';
                    }

                    $value .= $score . ':' .  $item;

                } else {
                    $value .= ', ..';
                    break;
                }
            }
            $value = '[ ' . $value . ' ]';
        }
        elseif ( $type == 'list' )
        {
            $size = R::factory()->lSize( $key );
            $value = '';
            foreach ( R::factory()->lRange( $key, 0, 100 ) as $item )
            {
                if ( strlen( $value ) < ($max - 5) )
                {
                    if ( ! empty($value) )
                    {
                        $value .= ', ';
                    }
                    $value .= $item;
                } else {
                    $value .= ', ..';
                    break;
                }
            }
            $value = '[ ' . $value . ' ]';
        }
        elseif ( $type == 'hash' )
        {
            $size = R::factory()->hLen( $key );
            $value = '';
            foreach ( R::factory()->hKeys( $key ) as $item )
            {
                if ( strlen( $value ) < ($max - 5) )
                {
                    if ( ! empty($value) )
                    {
                        $value .= ', ';
                    }
                    $value .= $item;
                } else {
                    $value .= ', ..';
                    break;
                }
            }
            $value = '[ ' . $value . ' ]';
        }

        return array($size, $value);
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

        $start  = ($this->page - 1) * Config::get( 're_limit' );
        $end    = $start + Config::get( 're_limit' );
        $keys   = array();
        foreach ( R::factory()->lRange( $lKey, $start, $end ) as $key )
        {
            $keys[] = array(
                                'key'   => $key,
                                'type'  => $this->getType( $key ),
                                'value' => $this->getValue( $key, $this->getType($key) )
                            );
        }

        $total  = R::factory()->lSize( $lKey );

        $dataUrl = array(
            'cmd'   => $this->cmd,
            'db'    => $this->db,
        );
        $url    = '/?'. http_build_query( $dataUrl ) . '&page=:id:';
        $paginator = Paginator::parsePaginator( $total, $this->page, $url, Config::get( 're_limit' ) );

        $data = array(
                        'db'        => $this->db,
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
