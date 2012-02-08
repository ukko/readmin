<h5><?php echo htmlspecialchars($command, ENT_QUOTES) ?></h5>
<?php echo $paginator ?>
<table>
    <thead>
        <tr>
            <th class="span4">index</th>
            <th>value</th>
            <th class="span2">edit</th>
            <th class="span2">delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach( $value as $k => $v ) : ?>
        <tr>
            <td><?php echo $k + $start ?></td>
            <td><?php echo htmlspecialchars($v, ENT_QUOTES) ?></td>
            <td> - </td>
            <td><?php echo Helper_Lists::anchorActionDelete( $key, $v ) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $paginator ?>
