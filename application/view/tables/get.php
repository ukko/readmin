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
                <div class="span9 overflow edit"
                     cmd="<?php echo $key ?>"
                     data-key="<?php echo htmlspecialchars($key, ENT_QUOTES) ?>"
                     data-load="/?db=0&format=raw&cmd=GET+test.s"
                     data-save="/?db=0&cmd=SET+test.s">
                    <?php echo htmlspecialchars($value, ENT_QUOTES) ?>
                </div>
            </td>
            <td>
                <div class="btn-group">
                    <a class="btn " data-toggle="dropdown" href="#">
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
