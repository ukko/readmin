<h5>HGETALL <?php echo htmlspecialchars($key, ENT_QUOTES) ?></h5>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td class="span2">Field</td>
			<td class="span8">Value</td>
            <td class="span1">Action</td>
		</tr>
	<thead>
	<tbody>
		<?php foreach( $value as $k => $v ) : ?>
		<tr>
		    <td><?php echo htmlspecialchars($k, ENT_QUOTES) ?></td>
		    <td><?php echo htmlspecialchars($v, ENT_QUOTES) ?></td>
            <td>
                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-pencil"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><?php echo Helper_Hashes::anchorActionEdit( $key, $k ) ?></li>
                        <li><?php echo Helper_Hashes::anchorActionDelete( $key, $k ) ?></li>
                    </ul>
                </div>
            </td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
