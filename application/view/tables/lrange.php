<div>
    <table>
        <caption><?= $key ?></caption>
        <thead>
            <tr>
                <th>index</th>
                <th>value</th>
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
