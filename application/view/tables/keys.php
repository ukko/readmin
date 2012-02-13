<h5 var-cmd="<?php echo $cmd ?>">
    <?php echo htmlspecialchars($cmd, ENT_QUOTES) ?>
    <small class="pull-right">
        <?php echo Helper_Keys::anchorActionClearCache($cache, $cmd) ?>
    </small>
</h5>
<?php echo $paginator ?>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th style="width: 20px; text-align: left;"><input type="checkbox"></th>
        <th class="span1">Type</th>
        <th>Key</th>
        <th class="span1">Action</th>
    </tr>
    </thead>
    <tbody>

    <?php if (isset($keys)) : ?>
        <?php foreach ($keys as $item) : ?>
        <tr>
            <td><input type="checkbox" id="<?php echo $item['key'] ?>"/></td>
            <td>
                <span class="label label-info"><?php echo $item['type'] ?></span><?php if ($item['ttl'] > 0) : ?><i class="icon-time" data-placement="right" rel='twipsy' title='TTL <?php echo $item['ttl'] ?>'></i><?php endif; ?>
            </td>
            <td>
                <span class="overflow"><?php echo Helper_Keys::anchorKey($item['key'], $item['type'], $db) ?></span>
                &nbsp;
                <span class="small"><?php echo htmlspecialchars(Helper_Keys::value($item['value'])) ?></span>
                <span class="label pull-right"><?php echo Helper_Keys::size($item['value']) ?></span>
            </td>
            <td>
                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-pencil"></i> <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><?php echo Helper_Keys::anchorAction($item['key'], $item['type'], Helper_Keys::ACTION_EXPIRE) ?></li>
                        <li><?php echo Helper_Keys::anchorAction($item['key'], $item['type'], Helper_Keys::ACTION_RENAME) ?></li>
                        <li><?php if ($item['ttl'] > 0) echo Helper_Keys::anchorAction($item['key'], $item['type'], Helper_Keys::ACTION_PERSIST) ?></li>
                        <li class="divider"></li>
                        <li><?php echo Helper_Keys::anchorAction($item['key'], $item['type'], Helper_Keys::ACTION_MOVE) ?></li>
                        <li><?php echo Helper_Keys::anchorAction($item['key'], $item['type'], Helper_Keys::ACTION_DELETE) ?></li>
                    </ul>
                </div>
            </td>
        </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php echo $paginator ?>

<div class="container">
    <div class="pull-left hide checked-do">
        <div class="btn-group">
            <a class="btn btn-danger" href="#">Delete</a>
            <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#" value="delete">Delete</a></li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal">
        <div class="control-group pull-right">
            <label class="control-label" for="limit">Limit items:</label>

            <div class="controls">
                <select id="limit" class="span1">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                    <option>all</option>
                </select>
            </div>
        </div>
    </form>
</div>

