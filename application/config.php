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
    'databases' => 17,

    // db for service data re:admin
    're_db'     => 0,

    // UI
    're_lang'   => 'ru', // @TODO

    // prefix for keys
    're_prefix' => 're:admin:',

    // limit items on page
    're_limit'  => 20,

    // limit time store key (sec.)
    're_store_time' => 1500,
);
