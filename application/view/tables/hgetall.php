<div>
    <table>
        <caption><?= $key ?></caption>
	<thead>
		<tr>
			<td>field</td>
			<td>value</td>
		</tr>
	<thead>
	<tbody>
		<?php foreach( $value as $k => $v ) : ?>
		<tr>
		    <td><?= $k ?></td>
		    <td><?= $v ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
    </table>
</div>
