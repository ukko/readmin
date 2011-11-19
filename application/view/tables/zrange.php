<div>
    <?= $paginator ?>
    <table>
        <caption>ZRANGE <?= $key . ' ' . $start . ' ' . $end ?> </caption>
        <thead>
            <tr>
                <th class="column span-2">rank</th>
                <th class="column span-3">score</th>
                <th>value</th>
                <th class="column span-2">edit</th>
                <th class="column span-2">delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $value as $value => $score ) : ?>
            <tr>
                <td><?= Command_ZSets::zRank( $key, $value ) ?></td>
                <td><?= $score ?></td>
                <td><?= $value ?></td>
		        <td> - </td>
		        <td><?= Helper_ZSets::anchorActionDelete( $key, $value ) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $paginator ?>
</div>
