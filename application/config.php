<?php
/**
 * Config file
 */
return array(
    // Connection
    'host'      => '127.0.0.1',
    'port'      => '6379',

    // Params
    'databases' => 16, // @FIXME

    // db for service data re:admin
    're_db'     => 0,

    // UI
    're_lang'   => 'ru', // @TODO

    // prefix for keys
    're_prefix' => 're:admin:',

    // limit items on page
    're_limit'  => 20,
);
