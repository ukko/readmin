<h5>HGETALL <?php echo htmlspecialchars($key, ENT_QUOTES) ?></h5>
<table>
	<thead>
		<tr>
			<td class="span4">field</td>
			<td>value</td>
            <td class="span2">edit</td>
            <td class="span2">delete</td>
		</tr>
	<thead>
	<tbody>
		<?php foreach( $value as $k => $v ) : ?>
		<tr>
		    <td><?php echo htmlspecialchars($k, ENT_QUOTES) ?></td>
		    <td><?php echo htmlspecialchars($v, ENT_QUOTES) ?></td>
            <td><?php echo '-' ?></td>
            <td><?php echo Helper_Hashes::anchorActionDelete( $key, $k ) ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
