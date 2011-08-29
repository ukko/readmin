<div>
    <table>
        <caption>LRANGE <?= htmlspecialchars($key, ENT_QUOTES) ?> 0 -1</caption>
        <thead>
            <tr>
                <th class="column span-4">index</th>
                <th>value</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $value as $k => $v ) : ?>
            <tr>
                <td><?= $k ?></td>
                <td><?= htmlspecialchars($v, ENT_QUOTES) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
