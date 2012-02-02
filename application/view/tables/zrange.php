<div>
    <h5><?php echo $command ?></h5>
    <?php echo $paginator ?>
    <table>
        <thead>
            <tr>
                <th class="span2">rank</th>
                <th class="span3">score</th>
                <th>value</th>
                <th class="span2">edit</th>
                <th class="span2">delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $value as $value => $score ) : ?>
            <tr>
                <td><?php echo Command_ZSets::zRank( $key, $value ) ?></td>
                <td><?php echo $score ?></td>
                <td><?php echo $value ?></td>
		        <td> - </td>
		        <td><?php echo Helper_ZSets::anchorActionDelete( $key, $value ) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $paginator ?>
</div>
