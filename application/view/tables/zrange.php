<div>
    <table>
        <caption><?= $key ?></caption>
        <thead>
            <tr>
                <th>value</th>
                <th>score</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $value as $k => $v ) : ?>
            <tr>
                <td><?= $k ?></td>
                <td><?= $v ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
