<?php
/**
 * Delete keys by mask
 */
$redis = new Redis();
$redis->connect('127.0.0.1');
$redis->select(0);

$patterns = array(
    'test:*',
);

foreach ( $patterns as $pattern )
{
    foreach ( $redis->keys( $pattern ) as $key )
    {
        $redis->del( $key );
    }
}
