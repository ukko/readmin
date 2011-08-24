<div>
    <table>
        <caption>SMEMBERS <?= $key ?></caption>
        <?php foreach( $value as $k => $v ) : ?>
        <tr>
            <td><?= $v ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
