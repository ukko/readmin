<h5>TTL <?php echo htmlspecialchars($key, ENT_QUOTES) ?></h5>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>key</td>
            <td class="span2">ttl</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo htmlspecialchars($key, ENT_QUOTES) ?></td>
            <td><?php echo $ttl ?></td>
		</tr>
	</tbody>
</table>
