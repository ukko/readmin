<?php
/**
 * Config file
 */
return array(
    // Redis connection
//    'host'      => '127.0.0.1', // Redis host
//    'port'      => '6379',      // Redis port
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
            'host'      => '127.0.0.1',
            'port'      => '6379',
            'users'     => array( // user => permissions: write || read
                'admin' => 'write',
                'user'  => 'read',
            ),
        ),
        array(
            'host'      => '127.0.0.1',
            'port'      => '6380',
            'users'     => array(
                'user'  => 'write',
            ),
        ),
    ),
    'users'     => array( // login => sha1( password)
        'admin'     => 'd033e22ae348aeb5660fc2140aec35850c4da997',
        'user'      => '12dea96fec20593566ab75692c9949596833adc9',
    ),
);
