<div>
    <table>
        <caption><?= $key ?></caption>
        <?php foreach( $value as $k => $v ) : ?>
        <tr>
            <td><?= $k ?></td>
            <td><?= $v ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
