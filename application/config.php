<?php
/**
 * Config file
 */
return array(
    // Redis connection
    'host'      => '192.168.2.157', // Redis host
    'port'      => '6379',      // Redis port
    'timeout'   => 3,           // Redis timeout connect

    // Max count databases
    'databases' => 16,

    // default database
    're_db'     => 0,

    // UI
    're_lang'   => 'ru', // @TODO

    // prefix for keys
    're_prefix' => 're:',

    // limit items on page
    're_limit'  => 20,

    // limit pages in paginator
    're_pages'  => 10,

    // limit time store key (sec.)
    're_store_time' => 1500,

    'hosts' => array(
        array(
            'host'   => '127.0.0.1',
            'port'   => '6379',
            ),
        array(
            'host'   => '192.168.2.157',
            'port'   => '6379',
            ),
        array(
            'host'   => '192.168.2.157',
            'port'   => '6380',
            ),
    ),
    'users'     => array(
        'ukko'    => '601f1889667efaebb33b8c12572835da3f027f78',
        'rashit'  => '601f1889667efaebb33b8c12572835da3f027f78',
    ),
);
