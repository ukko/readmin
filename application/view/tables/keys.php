<h5 var-cmd="<?php echo $cmd ?>">
    <?php echo htmlspecialchars($cmd, ENT_QUOTES) ?>
    <small class="pull-right">
    <?php echo Helper_Keys::anchorActionClearCache($cache, $cmd) ?>
    </small>
</h5>
<?php echo $paginator ?>
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
        <td><input type="checkbox" id="<?php echo $item['key'] ?>" /></td>
        <td>
            <span class="label notice"><?php echo $item['type'] ?></span>
            <?php if ( $item['ttl'] > 0) : ?>
            <a data-placement="right" rel='twipsy' title='TTL <?php echo $item['ttl'] ?>'>⌚</a>
            <?php endif; ?>
        </td>
        <td>
            <?php echo Helper_Keys::anchorKey( $item['key'], $item['type'], $db ) ?>
            &nbsp;
            <span class="small"><?php echo Helper_Keys::value( $item['value'] ) ?></span>
            <span class="label pull-right"><?php echo Helper_Keys::size( $item['value'] ) ?></span>
        </td>
        <td>
            <div class="popup noactive">
                <span>Action ▿</span>
                <ul class="menu">
                    <li><?php echo Helper_Keys::anchorAction( $item['key'], $item['type'], Helper_Keys::ACTION_EXPIRE ) ?></li>
                    <li><?php echo Helper_Keys::anchorAction( $item['key'], $item['type'], Helper_Keys::ACTION_RENAME ) ?></li>
                    <li><?php if ( $item['ttl'] > 0 ) echo Helper_Keys::anchorAction( $item['key'], $item['type'], Helper_Keys::ACTION_PERSIST ) ?></li>
                    <li><?php echo Helper_Keys::anchorAction( $item['key'], $item['type'], Helper_Keys::ACTION_MOVE ) ?></li>
                    <li><?php echo Helper_Keys::anchorAction( $item['key'], $item['type'], Helper_Keys::ACTION_DELETE ) ?></li>
                </ul>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<div class="container">
    <div class="pull-left">
        <label for="do_with_checked">Checked items:</label>
            <select id="do_with_checked" class="span2">
                <option>&nbsp;</option>
                <option value="delete">Delete</option>
            </select>
    </div>

    <div class="pull-right">
        <label for="limit">Limit items:</label>
        <select id="limit" class="span1">
            <option>10</option>
            <option>20</option>
            <option>50</option>
            <option>all</option>
        </select>
    </div>
</div>
<?php echo $paginator ?>
