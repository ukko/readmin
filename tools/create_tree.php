<?php
$start = microtime(true);

$redis = new Redis();
$redis->connect('127.0.0.1');
echo 'DB size: ' . $redis->dbSize() . PHP_EOL;
echo '___________________________'.PHP_EOL;

$p = array();
$keys = $redis->keys('*');
$d = ':';
$z = 'readmin:patterns';

foreach ($keys as $key) {
    $parts = explode($d, $key);
    $pk = '';
    foreach ($parts as $key => $part) {
        if ($key == count($parts)-1) {
            // Добавляем строки только первого уровня
            if (count($parts) == 1) {
                $pk .= $part;
            }
        } else {
            $pk .= $part . $d . '*';
        }

        if (array_key_exists($pk, $p)) {
            $p[$pk] = $p[$pk] + 1;
        } else {
            $p[$pk] = 1;
        }
    }

}

// Добавляем шаблоны в редис
$redis->del($z);
foreach ($p as $key => $value) {
    $redis->zadd($z, $value, $key);
}

echo 'Time ago: ' . (microtime(true) - $start) . PHP_EOL;

