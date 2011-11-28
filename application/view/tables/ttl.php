<h5>TTL <?= htmlspecialchars($key, ENT_QUOTES) ?></h5>
<table>
	<thead>
		<tr>
			<td>key</td>
            <td class="span2">ttl</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?= htmlspecialchars($key, ENT_QUOTES) ?></td>
            <td><?= $ttl ?></td>
		</tr>
	</tbody>
</table>
