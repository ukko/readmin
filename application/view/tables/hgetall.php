<div>
    <table>
        <caption>HGETALL <?= htmlspecialchars($key, ENT_QUOTES) ?></caption>
	<thead>
		<tr>
			<td class="column span-4">field</td>
			<td>value</td>
            <td class="column span-2">edit</td>
            <td class="column span-2">delete</td>
		</tr>
	<thead>
	<tbody>
		<?php foreach( $value as $k => $v ) : ?>
		<tr>
		    <td><?= htmlspecialchars($k, ENT_QUOTES) ?></td>
		    <td><?= htmlspecialchars($v, ENT_QUOTES) ?></td>
            <td><?= '-' ?></td>
            <td><?= Helper_Hashes::anchorActionDelete( $key, $k ) ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
    </table>
</div>
