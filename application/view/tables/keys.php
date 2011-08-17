<?= $paginator ?>
<table>
     <caption><?= $command ?></caption>
    <thead>
        <tr>
            <td class="check"><input type="checkbox" /></td>
            <td class="type">type</td>
            <td class="key">key</td>
            <td class="actions">actions</td>
        </tr>
    </thead>
    <tbody>
        <?php if ( isset( $keys ) ) : ?>
        <?php foreach ( $keys as $item ) : ?>
        <tr>
            <td><input type="checkbox" id="<?= $item['key'] ?>" /></td>
            <td><?= $item['type'] ?></td>
            <td><?= Helper_Keys::anchorKey( $item['key'], $item['type'] ) ?></td>
            <td>
                <?= Helper_Keys::anchorAction( $item['key'], $item['type'], 'delete' ) ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<?= $paginator ?>
