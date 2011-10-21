<div>
    <?= $paginator ?>
    <table>
        <caption>ZRANGE <?= $key ?> 0 -1</caption>
        <thead>
            <tr>
                <th class="column span-2">rank</th>
                <th class="column span-3">value</th>
                <th>score</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach( $value as $k => $v ) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $k ?></td>
                <td><?= $v ?></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $paginator ?>
</div>
