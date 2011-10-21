<?php
/**
 * Config file
 */
return array(
    // Connection
    'host'      => '192.168.2.157',
    'port'      => '6379',

    // Params
    'databases' => 17, // @FIXME

    // db for service data re:admin
    're_db'     => 0,

    // UI
    're_lang'   => 'ru', // @TODO

    // prefix for keys
    're_prefix' => 're:admin:',

    // limit items on page
    're_limit'  => 20,
);
