<table>
	<caption>GET <?= htmlspecialchars($key, ENT_QUOTES) ?></caption>
	<thead>
		<tr>
			<td>value</td>
            <td class="column span-2">edit</td>
            <td class="column span-2">delete</td>
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
