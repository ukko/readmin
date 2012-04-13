<?php
/**
 * Fill db mockup values
 */
$redis = new Redis();
$redis->connect('127.0.0.1');
$redis->select(0);

$count      = 10000;
$microtime  = microtime(true);

echo "Start fill redis db\n";

// HSET
for ( $i = 0; $i <= $count; $i++ )
{
    for ( $j = 0; $j <= 100; $j++ )
    {
        $data['field' . $j] = md5($j);
    }

    $redis->hMset('test:' . $i . ':hset', $data);
}

echo "Add $count hset keys, time: " . microtime(1) - $microtime . PHP_EOL;
$microtime = microtime( true );

// SET
for ( $i = 0; $i <= $count; $i++ )
{
    $data = array('test:' . $i . ':set') + range(0, 100);

    call_user_func_array( array($redis, 'sadd'), $data );
}

echo "Add $count set keys, time: " . microtime(1) - $microtime . PHP_EOL;
$microtime = microtime( true );

// LIST
for ( $i = 0; $i <= $count; $i++ )
{
    for ( $j = 0; $j <= 100; $j++ )
    {
        $redis->rPush('test:' . $i . ':list', $j );
    }
}

echo "Add $count list keys, time: " . microtime(1) - $microtime . PHP_EOL;
$microtime = microtime( true );

// STRING
for ( $i = 0; $i <= rand(1000, 10000); $i++ )
{
    for ( $j = 0; $j <= rand(10, 100); $j++ )
    {
        $redis->set('test:' . $i . ':string', $j );
    }
}

echo "Add $count string keys, time: " . microtime(1) - $microtime . PHP_EOL;
$microtime = microtime( true );

// ZSET
for ( $i = 0; $i <= $count; $i++ )
{
    for ( $j = 0; $j <= rand(10, 100); $j++ )
    {
        $redis->zAdd('test:' . $i . ':zset', $j, md5($j) );
    }
}

echo "Add $count zset keys, time: " . microtime(1) - $microtime . PHP_EOL;
$microtime = microtime( true );

