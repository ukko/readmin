<h5>HGETALL <?php echo htmlspecialchars($key, ENT_QUOTES) ?></h5>
<table>
	<thead>
		<tr>
			<td class="span4">Field</td>
			<td>Value</td>
            <td class="span2">Action</td>
		</tr>
	<thead>
	<tbody>
		<?php foreach( $value as $k => $v ) : ?>
		<tr>
		    <td><?php echo htmlspecialchars($k, ENT_QUOTES) ?></td>
		    <td><?php echo htmlspecialchars($v, ENT_QUOTES) ?></td>
            <td>
                <div class="popup noactive">
                    <span>Action ▿</span>
                    <ul class="menu">
                        <li><?php echo Helper_Hashes::anchorActionDelete( $key, $k ) ?></li>
                        <li><?php echo Helper_Hashes::anchorActionEdit( $key, $k ) ?></li>
                    </ul>
                </div>
            </td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
