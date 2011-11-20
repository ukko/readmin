<h5>GET <?= htmlspecialchars($key, ENT_QUOTES) ?></h5>
<table>
	<thead>
		<tr>
			<td>value</td>
            <td class="span2">edit</td>
            <td class="span2">delete</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?= htmlspecialchars($value, ENT_QUOTES) ?></td>
            <td> - </td>
            <td><?= Helper_Strings::anchorActionDelete( $key ) ?></td>
		</tr>
	</tbody>
</table>
