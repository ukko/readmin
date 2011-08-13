#! /usr/bin/env php
<?php
/**
 * Redis dump keys and values in stdin or file
 *
 * @author  Max Kamashev <max.kamashev@gmail.com>
 * @link    https://github.com/ukko/readmin
 */

$redump = new Redump();
foreach ( $redump->getPatterns() as $pattern )
{
    $redump->dump($pattern);
}

class Redump
{
    /**
     * @var Redis
     */
    protected $redis        = null;
    protected $version      = null;

    // Default values
    protected $host         = '127.0.0.1';
    protected $port         = '6379';
    protected $socket       = null;
    protected $password     = '';
    protected $database     = 0;
    protected $delimiter    = "\n";
    protected $output       = null;

    protected $patterns     = array();
    protected $help         = false;

    /**
     * Return redis resource
     *
     * @return Redis
     */
    public function getRedis()
    {
        if ( ! $this->redis )
        {
            $this->redis = new Redis();

            if ( isset( $this->socket ) )
            {
                $this->redis->connect( $this->socket );
            }
            else
            {
                $this->redis->connect( $this->host, $this->port );
            }

            $this->redis->select( $this->database );
        }

        return $this->redis;
    }

    /**
     * Construct
     */
    public function __construct()
    {
        if ( ! class_exists( 'Redis' ) )
        {
            die("Requires installed extension phpredis\nhttps://github.com/nicolasff/phpredis\n");
        }

        if (PHP_SAPI == "cli")
        {
            $this->setOptions();
        }
        else
        {
            die("Please, use this script in cli interface\n");
        }

        $info          = $this->getRedis()->info();
        $this->version = $info['redis_version'];
    }

    /**
     * Set options from command line
     */
    public function setOptions()
    {
        $params = array(
            'help',
            'h::' => 'host::',
            'p::' => 'port::',
            's::' => 'socket::',
            'a::' => 'password::',
            'n::' => 'database::',
            'd::' => 'delimiter::',
            'o::' => 'output::',
        );

        $options = getopt( implode('', array_keys($params)), $params );

        if (isset($options['host']) || isset($options['h']))
        {
            $this->setHost( isset( $options['host'] ) ? $options['host'] : $options['h'] );
        }

        if (isset($options['port']) || isset($options['p']))
        {
            $this->setPort( isset( $options['port'] ) ? $options['port'] : $options['p'] );
        }

        if (isset($options['socket']) || isset($options['s']))
        {
            $this->setSocket( isset( $options['socket'] ) ? $options['socket'] : $options['s'] );
        }

        if (isset($options['password']) || isset($options['a']))
        {
            $this->setPassword( isset( $options['password'] ) ? $options['password'] : $options['a'] );
        }

        if (isset($options['database']) || isset($options['n']))
        {
            $this->setDatabase( isset( $options['database'] ) ? $options['database'] : $options['n'] );
        }

        if (isset($options['delimiter']) || isset($options['d']))
        {
            $this->setDelimiter( isset( $options['delimiter'] ) ? $options['delimiter'] : $options['d'] );
        }

        if (isset($options['output']) || isset($options['o']))
        {
            $this->setOutput( isset( $options['output'] ) ? $options['output'] : $options['o'] );
        }

        // Not defined pattern
        if ( isset( $options['help'] ) || isset($_SERVER['argc']) && $_SERVER['argc'] == 1 )
        {
            $this->help = true;
        }
        // Get patterns of keys
        elseif ( isset( $_SERVER['argv'] ) )
        {
            foreach ( $_SERVER['argv'] as $arg )
            {
                if ( $arg != $_SERVER['argv'][0] && substr($arg, 0, 1) != '-' )
                {
                    $this->addPattern( $arg );
                }
            }
        }

        if ( $this->help )
        {
            $this->help();
        }
    }

    /**
     * Dump data
     *
     * @param   string  $pattern
     * @return void
     */
    public function dump( $pattern )
    {
        foreach ( $this->getRedis()->keys( $pattern ) as $key )
        {
            $data   = '';
            $key    = addslashes( $key );

            switch( $this->getRedis()->type( $key ) )
            {
                case Redis::REDIS_STRING :
                {
                    $data = 'SET "' . $key . '" "' . $this->sanity( $this->getRedis()->get( $key ) ) . '"' . PHP_EOL;
                    break;
                }
                case Redis::REDIS_SET :
                {
                    $sMembers   = implode( '" "', $this->sanity( $this->getRedis()->sMembers( $key ) ) );
                    $data       = 'SADD "' . $key . '" "' . $sMembers . '"' . PHP_EOL;
                    break;
                }
                case Redis::REDIS_LIST :
                {
                    $list = implode( '" "', $this->sanity( $this->getRedis()->lRange( $key, 0, -1 ) ) );
                    $data = 'RPUSH "' . $key . '" "' . $list . '"' . PHP_EOL;
                    break;
                }
                case Redis::REDIS_ZSET :
                {
                    $data = $this->dumpZset( $key );
                    break;
                }
                case Redis::REDIS_HASH :
                {
                    $data = 'HMSET "' . $key . '"';
                    foreach ( $this->getRedis()->hGetAll($key) as $field => $value )
                    {
                        if ( $value )
                        {
                            $data .= ' "'. $this->sanity( $field ) . '" "' . $this->sanity( $value ) . '"';
                        }
                    }
                    $data .= PHP_EOL;
                    break;
                }
                default :
                {
                    echo $key . PHP_EOL;
                }
            }

            if ( ! empty($data) )
            {
                if ( $this->output )
                {
                    file_put_contents($this->output, $data, FILE_APPEND);
                }
                else
                {
                    echo $data;
                }
            }
        }

    }

    /**
     * Dump zset-struct
     *
     * @param   string  $key
     * @return  string
     */
    private function dumpZset( $key )
    {
        $i          = 1;
        $command    = 'ZADD "' . $key . '"';
        $data       = $command;
        $maxLen     = 10000;

        foreach ($this->getRedis()->zRange($key, 0, -1, true) as $member => $score)
        {
            // Split command by ~10000 chars
            // 4354 > 10000 -
            // 9000 > 10000 -
            // 13000 > 10000 +
            // 13000 * 2 >
            if ( strlen( $data ) > ( $maxLen * $i ) )
            {
                $data .= PHP_EOL . $command;
                $i++;
            }

            $data .= ' '. (float) $score . ' "' . $this->sanity( $member ) . '"';
        }
        return $data .= PHP_EOL;
    }

    /**
     * Show help message
     */
    private function help()
    {
        if ( $this->help )
        {
            $help = "
usage: php redump.php [--help] [-h|--host=127.0.0.1] [-p|--port=6379]
                      [-s|--socket=/tmp/redis.sock] [-a|--password=secret]
                      [-n|--database=0] [-d|--delimiter='\\n']
                      [-o|output=/path/to/output/file] <patterns>

Options:
            --help      Show this message
        -h  --host      Server hostname (default: 127.0.0.1)
        -p  --port      Server port (default: 6379)
        -s  --socket    Server socket (overrides hostname and port)
        -a  --password  Password to use when connecting to the server
        -n  --database  Database number (default: 0)
        -d  --delimiter Multi-bulk delimiter in raw formatting (default: \\n)
        -o  --output    Output file
Example:
        php redump.php \"pattern:1:*\" > ./redis-keys.txt
        php redump.php \"pattern:1:*\" \"*pattern:2:*\" > ./databypatterns.txt
        php redump.php --host=192.168.0.1 --port=6379 \"*\" > ./redis-data.txt
        php redump.php -h127.0.0.1 -p6379 \"pattern:1:1*\"
";
            die($help);
        }
    }

    /**
     * Sanitization values
     *
     * @param $data
     * @return string
     */
    private function sanity( $data )
    {
//        $value = str_replace("\r", ' ', str_replace("\n", ' ', $value));
        $result = array();
        if ( is_array( $data ) )
        {
            foreach ( $data as $value )
            {
                $result[] = addslashes( $value );
            }
        }
        else
        {
            $result = addslashes( $data );
        }

        return $result;
    }

    public function setSocket($socket)
    {
        $this->socket = $socket;
    }

    public function getSocket()
    {
        return $this->socket;
    }

    public function setPort($port)
    {
        $this->port = $port;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setOutput($output)
    {
        $this->output = $output;
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function setHost($host)
    {
        $this->host = $host;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;
    }

    public function getDelimiter()
    {
        return $this->delimiter;
    }

    public function setDatabase($database)
    {
        $this->database = $database;
    }

    public function getDatabase()
    {
        return $this->database;
    }

    public function setPatterns($patterns)
    {
        $this->patterns = $patterns;
    }

    public function getPatterns()
    {
        return $this->patterns;
    }

    public function addPattern( $pattern )
    {
        $patterns = $this->getPatterns();
        $patterns[] = $pattern;
        $this->setPatterns( $patterns );
    }
}
