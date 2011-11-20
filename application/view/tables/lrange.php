<h5>LRANGE <?= htmlspecialchars($key, ENT_QUOTES) . ' ' . $start . ' ' . $end ?></h5>
<?= $paginator ?>
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
            <td><?= $k + $start ?></td>
            <td><?= htmlspecialchars($v, ENT_QUOTES) ?></td>
            <td> - </td>
            <td><?= Helper_Lists::anchorActionDelete( $key, $v ) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $paginator ?>
