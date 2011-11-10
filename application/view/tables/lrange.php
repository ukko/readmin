<div>
    <table>
        <caption>LRANGE <?= htmlspecialchars($key, ENT_QUOTES) . ' ' . $start . ' ' . $end ?> </caption>
        <thead>
            <tr>
                <th class="column span-4">index</th>
                <th>value</th>
                <th class="column span-2">edit</th>
                <th class="column span-2">delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $value as $k => $v ) : ?>
            <tr>
                <td><?= $k ?></td>
                <td><?= htmlspecialchars($v, ENT_QUOTES) ?></td>
                <td> - </td>
                <td><?= Helper_Lists::anchorActionDelete( $key, $v ) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
