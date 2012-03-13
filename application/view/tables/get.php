<h5 var-cmd="<?php echo $cmd ?>">GET <?php echo htmlspecialchars($key, ENT_QUOTES) ?></h5>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th class="span10">Value</th>
            <th class="action">Action</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
                <div class="span9 overflow textarea"
                     data-cmd="SET <?php echo $key ?> "
                     data-load="<?php echo '/?db=' . Request::factory()->getDb() . '&format=raw&cmd=GET+' . $key ?>"
                     data-save="<?php echo '/?db=' . Request::factory()->getDb() . '&format=raw' ?>">
                    <?php echo htmlspecialchars($value, ENT_QUOTES) ?>
                </div>
            </td>
            <td>
                <div class="btn-group">
                    <a class="btn textarea" data-toggle="dropdown" href="#">
                        <i class="icon-pencil"></i>
                    </a>
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><?php echo Helper_Strings::anchorActionDelete( $key ) ?></li>
                    </ul>
                </div>

            </td>
		</tr>
	</tbody>
</table>
