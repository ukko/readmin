<?php
function anchorKey($key, $type)
{
    $data = array(
        'db' => 0,
    );

    if ($type == 'string')
    {
        $data['cmd'] = 'GET ' . $key;
    }
    elseif ( $type == 'hash' )
    {
        $data['cmd'] = 'HGETALL ' . $key;
    }
    elseif( $type == 'list' )
    {
        $data['cmd'] = 'LRANGE ' . $key . ' 0 -1';
    }
    elseif ( $type == 'set' )
    {
        $data['cmd'] = 'SMEMBERS ' . $key;
    }
    elseif( $type == 'zset' )
    {
        $data['cmd'] = 'ZRANGE ' . $key . ' 0 -1';
    }

    $url = http_build_query($data);
    return '<a href="/?' . $url  . '">' . $key . '</a>';
}
?>

<?= $paginator ?>
<table>
     <caption><?= $command ?></caption>
    <thead>
        <tr>
            <td class="check"><input type="checkbox" /></td>
            <td class="type">type</td>
            <td class="key">key</td>
        </tr>
    </thead>
    <tbody>
        <?php if ( isset( $keys ) ) : ?>
        <?php foreach ( $keys as $item ) : ?>
        <tr>
            <td><input type="checkbox" id="<?= $item['key'] ?>" /></td>
            <td><?= $item['type'] ?></td>
            <td><?= anchorKey( $item['key'], $item['type']) ?></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<?= $paginator ?>
