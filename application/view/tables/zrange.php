<h5><?php echo $command ?></h5>
<?php echo $paginator ?>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th class="span1">Rank</th>
        <th class="span2">Score</th>
        <th class="span8">Value</th>
        <th class="span1">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($value as $value => $score) : ?>
    <tr>
        <td><?php echo Command_ZSets::zRank($key, $value) ?></td>
        <td><?php echo $score ?></td>
        <td><?php echo $value ?></td>
        <td>
            <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-pencil"></i> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php echo Helper_ZSets::anchorActionDelete($key, $value) ?>
                </ul>
            </div>
        </td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $paginator ?>
