<div>
    <table>
        <caption>SMEMBERS <?= htmlspecialchars($key, ENT_QUOTES) ?></caption>
        <?php foreach( $value as $k => $v ) : ?>
        <tr>
            <td><?= htmlspecialchars($v, ENT_QUOTES) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
