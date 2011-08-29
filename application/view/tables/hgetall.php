<div>
    <table>
        <caption>HGETALL <?= htmlspecialchars($key, ENT_QUOTES) ?></caption>
	<thead>
		<tr>
			<td class="column span-4">field</td>
			<td>value</td>
		</tr>
	<thead>
	<tbody>
		<?php foreach( $value as $k => $v ) : ?>
		<tr>
		    <td><?= htmlspecialchars($k, ENT_QUOTES) ?></td>
		    <td><?= htmlspecialchars($v, ENT_QUOTES) ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
    </table>
</div>
