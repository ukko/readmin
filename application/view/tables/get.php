<h5>GET <?php echo htmlspecialchars($key, ENT_QUOTES) ?></h5>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td class="span11">Value</td>
            <td class="span1">Action</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo htmlspecialchars($value, ENT_QUOTES) ?></td>
            <td>
                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-pencil"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php echo Helper_Strings::anchorActionDelete( $key ) ?>
                    </ul>
                </div>
            </td>
		</tr>
	</tbody>
</table>
