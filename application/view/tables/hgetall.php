<h5>HGETALL <?php echo htmlspecialchars($key, ENT_QUOTES) ?></h5>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th class="span2">Field</th>
        <th class="span8">Value</th>
        <th class="action">Action</th>
    </tr>
    <thead>
    <tbody>
    <?php foreach ($value as $k => $v) : ?>
    <tr>
        <td>
            <div class="span2 overflow"><?php echo htmlspecialchars($k) ?></div>
        </td>
        <td>
            <div class="span7 overflow textarea"
                 data-cmd="HSET <?php echo $key . ' ' . $k ?> "
                 data-load="<?php echo '/?db=' . Request::factory()->getDb() . '&format=raw&cmd=HGET+' . $key . '+' . $k . '+' ?>"
                 data-save="<?php echo '/?db=' . Request::factory()->getDb() . '&format=raw' ?>">
                <?php echo htmlspecialchars($v) ?>
            </div>
        </td>
        <td>
            <div class="btn-group">
                <a class="btn textarea" data-toggle="dropdown" href="#"><i class="icon-pencil"></i></a>
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>

                <ul class="dropdown-menu">
                    <li><?php echo Helper_Hashes::anchorActionEdit($key, $k) ?></li>
                    <li><?php echo Helper_Hashes::anchorActionDelete($key, $k) ?></li>
                </ul>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
