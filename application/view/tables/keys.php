<h5><?= htmlspecialchars($cmd, ENT_QUOTES) ?></h5>
<?= $paginator ?>
<table class="bordered-table zebra-striped">
    <thead>
    <tr>
        <th class="span1"><input type="checkbox"></th>
        <th class="span2">Type</th>
        <th>Key</th>
        <th class="span2">Action</th>
    </tr>
    </thead>
    <tbody>

    <?php if ( isset( $keys ) ) : ?>
    <?php foreach ( $keys as $item ) : ?>
    <tr>
        <td><input type="checkbox" id="<?= $item['key'] ?>" /></td>
        <td>
            <span class="label notice"><?= $item['type'] ?></span>
            <?= ($item['ttl'] > 0) ? '<span>⌚ '. $item['ttl'] . '</span>':'' ?>
        </td>
        <td>
            <?= Helper_Keys::anchorKey( $item['key'], $item['type'], $db ) ?>
            &nbsp;
            <span class="small"><?= Helper_Keys::value( $item['value'] ) ?></span>
            <span class="label pull-right"><?= Helper_Keys::size( $item['value'] ) ?></span>
        </td>
        <td>
            <div class="popup noactive">
                <span>Action ▿</span>
                <ul class="menu">
                    <li><?= Helper_Keys::anchorAction( $item['key'], $item['type'], Helper_Keys::ACTION_EXPIRE ) ?>
                    <li><?= Helper_Keys::anchorAction( $item['key'], $item['type'], Helper_Keys::ACTION_RENAME ) ?>
                    <li><?= Helper_Keys::anchorAction( $item['key'], $item['type'], Helper_Keys::ACTION_DELETE ) ?></li>
                </ul>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<?= $paginator ?>
