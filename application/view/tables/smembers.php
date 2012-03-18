<h5>SMEMBERS <?php echo htmlspecialchars($key, ENT_QUOTES) ?></h5>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th class="span10">Value</th>
        <th class="span1">Action</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach( $value as $k => $v ) : ?>
        <tr>
            <td>
                <div class="span7 overflow textarea"
                     data-cmd="LSET <?php echo $key . ' ' . ($k+$start) ?> "
                     data-load="<?php echo '/?db=' . Request::factory()->getDb() . '&format=raw&cmd=LINDEX+' . $key . '+' . ($k + $start) ?>"
                     data-save="<?php echo '/?db=' . Request::factory()->getDb() . '&format=raw' ?>">
                    <?php echo htmlspecialchars($v, ENT_QUOTES) ?>
                </div>
            </td>
            <td>
                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-pencil"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    </ul>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
