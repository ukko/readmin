<?php

$redis = new Redis();
$redis->connect('127.0.0.1');

// HSET
for ( $i = 0; $i <= rand(1000, 10000); $i++ )
{
    $incr = $redis->incr('test:incr:hset');

    $data = array();

    for ( $j = 0; $j <= rand(10, 500); $j++ )
    {
        $data['field' . $j] = md5($j);
    }


    $redis->hMset('test:' . $incr . ':hset', $data);
}

// SET
for ( $i = 0; $i <= rand(1000, 10000); $i++ )
{
    $incr = $redis->incr('test:incr:set');

    for ( $j = 0; $j <= rand(10, 100); $j++ )
    {
        $redis->sAdd('test:' . $incr . ':set', $j );
    }
}

// LIST
for ( $i = 0; $i <= rand(1000, 10000); $i++ )
{
    $incr = $redis->incr('test:incr:list');

    for ( $j = 0; $j <= rand(10, 100); $j++ )
    {
        $redis->rPush('test:' . $incr . ':list', $j );
    }
}

// STRING
for ( $i = 0; $i <= rand(1000, 10000); $i++ )
{
    $incr = $redis->incr('test:incr:string');

    for ( $j = 0; $j <= rand(10, 100); $j++ )
    {
        $redis->set('test:' . $incr . ':string', $j );
    }
}



// SET
for ( $i = 0; $i <= rand(1000, 10000); $i++ )
{
    $incr = $redis->incr('test:incr:set');

    for ( $j = 0; $j <= rand(10, 100); $j++ )
    {
        $redis->zAdd('test:' . $incr . ':set', $j, md5($j) );
    }
}

