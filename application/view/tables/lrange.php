<h5><?php echo htmlspecialchars($command, ENT_QUOTES) ?></h5>
<?php echo $paginator ?>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th class="span1">Index</th>
        <th class="span9">Value</th>
        <th class="span1">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($value as $k => $v) : ?>
    <tr>
        <td><?php echo $k + $start ?></td>
        <td><?php echo htmlspecialchars($v, ENT_QUOTES) ?></td>
        <td>
            <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-pencil"></i> <span class="caret"></span></a>
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
