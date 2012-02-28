<?php
/**
 * Config file
 */
return array(
    // Redis connection
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

    // user => permissions: write || read
    'hosts' => array(
        '127.0.0.1:6379' => array(
            'admin' => 'write',
            'user' => 'read',
        ),
        '127.0.0.1:6380' => array(
            'ukko'  => 'write',
        ),
    ),

    // login => sha1( password)
    'users'     => array(
        'admin'     => 'd033e22ae348aeb5660fc2140aec35850c4da997',
        'user'      => '12dea96fec20593566ab75692c9949596833adc9',
    ),
);
