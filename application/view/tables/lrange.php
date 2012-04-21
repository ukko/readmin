<h5><?php echo htmlspecialchars($command, ENT_QUOTES) ?></h5>
<?php echo $paginator ?>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th class="span1">Index</th>
        <th class="span10">Value</th>
        <th class="action">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php  foreach ($value as $k => $v) : ?>
    <tr>
        <td><?php echo $k + $start ?></td>
        <td>
            <?php if ( $history ) : ?>
                <a class='cmd exec' href='<?php echo $v ?>'><?php echo htmlspecialchars($v, ENT_QUOTES) ?></a>
            <?php else : ?>
                <div class="span7 overflow textarea"
                     data-cmd="LSET <?php echo $key . ' ' . ($k+$start) ?> "
                     data-load="<?php echo '/?db=' . Request::factory()->getDb() . '&format=raw&cmd=LINDEX+' . $key . '+' . ($k + $start) ?>"
                     data-save="<?php echo '/?db=' . Request::factory()->getDb() . '&format=raw' ?>">
                    <?php echo htmlspecialchars($v, ENT_QUOTES) ?>
                </div>
            <?php endif; ?>
            </td>
        <td>
            <div class="btn-group">
                <a class="btn textarea dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-pencil"></i>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><?php echo Helper_Lists::anchorActionDelete($key, $v) ?></li>
                </ul>
            </div>
        </td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $paginator ?>
